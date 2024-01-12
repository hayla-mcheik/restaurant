<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\StatusEmailNotification;
use App\Mail\VerifyEmailNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveEmailNotification;
use App\Rules\GmailDomain;
use Illuminate\Auth\Events\Registered;
use App\Rules\EmailDomain;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use RegistersUsers;

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'min:8'],
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $roleAs = $request['role_as'] ?? 'admin'; 
        $roleAsValue = $this->getRoleAsValue($roleAs);
    
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone' => $request['phone'],
            'status' => $roleAsValue === 1 ? 'active' : 'pending',
            'role_as' => $roleAsValue,
        ]);
    
        if ($roleAsValue == 3) {
            event(new Registered($user));
        } elseif ($roleAsValue == 2) {
            Mail::to($user->email)->send(new StatusEmailNotification($user->name));
        } 
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }
    
    private function getRoleAsValue($role)
    {
        switch ($role) {
            case 'manager':
                return 2;
            case 'user':
                return 3;
            case 'admin':
                return 1;
            default:
                return 1; 
        }
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $this->authenticated($request, $user);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role_as == '3') {
            if (!$user->hasVerifiedEmail()) {
                auth()->logout();
                return response()->json(['status' => 'Your email is not verified. Please check your email for a verification link.'], 401);
            }
            
            $token = $user->createToken('token-name')->plainTextToken;
    
            return response()->json(['token' => $token, 'message' => 'Welcome to Dashboard']);
        } elseif ($user->role_as == '2') {
            if ($user->status == 'active') {
                $token = $user->createToken('token-name')->plainTextToken;
    
                return response()->json(['token' => $token, 'message' => 'Welcome to Dashboard']);
            } else {
                auth()->logout();
                Mail::to($user->email)->send(new ApproveEmailNotification($user->name));
                return response()->json(['status' => 'Your account is not yet active. Please wait for admin approval.'], 401);
            }
        } elseif ($user->role_as == '1') {
            $token = $user->createToken('token-name')->plainTextToken;   
            return response()->json(['token' => $token, 'message' => 'Welcome to Dashboard']);
        } else {
            auth()->logout();
            return response()->json(['status' => 'Unauthorized to access.'], 401);
        }
    }
    
}