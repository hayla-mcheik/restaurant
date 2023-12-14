<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\StatusEmailNotification; 
use App\Mail\VerifyEmailNotification; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered; 
use App\Rules\EmailDomain;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    protected function create(array $data)
    {
        $roleAs = $data['role_as'] ?? 'admin';
        $status = $roleAs == 1 ? 'active' : 'pending';
    
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'pending',
            'role_as' => $this->getRoleAsValue($roleAs),
    
        ]);
    if(empty($roleAs))
    {
        session()->flash('success', 'Thank you for signing up.');
    }
        if ($user->role_as == 3) {
            event(new Registered($user));
            session()->flash('success', 'Registration successful! Please check your email to verify your account.');
        } elseif ($user->role_as == 2) {
            Mail::to($user->email)->send(new StatusEmailNotification($user->name));
            session()->flash('success', 'Thank you for signing up, your account is under review, once approved, you will receive an email.');
        } 
        elseif ($user->role_as == 1) {
            session()->flash('success', 'Thank you for signing up.');
        } 
        else {
            session()->flash('error', 'Registration failed. Please try again.');
        }
    
        return $user;
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
    
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
