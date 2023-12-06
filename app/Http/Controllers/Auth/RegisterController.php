<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\VerifyEmailNotification; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered; 
use App\Rules\GmailDomain;
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
            'email' => ['required', 'email', 'unique:users,email', new GmailDomain],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'pending',
            'role_as' => $this->getRoleAsValue($data['role_as'] ?? 'user'),

        ]);
    
        if ($user) {
            Mail::to($user->email)->send(new VerifyEmailNotification($user->name));
            session()->flash('success', 'Registration successful! Please check your email to verify your account.');
        } else {
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
            default:
                return 3; 
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
