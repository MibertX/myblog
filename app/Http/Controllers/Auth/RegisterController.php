<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\Request;
use App\Jobs\SendActivationEmail;
use App\Repositories\UserRepository;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/article/all';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    
    public function register(RegisterRequest $request, UserRepository $userRepository)
    {
        $activationCode = str_random(30);
        $user = $userRepository->store($request->all(), $activationCode);

        $job = (new SendActivationEmail($user));
        $this->dispatch($job);

        return redirect('/')->with('info', 'To verify your account you have to follow the link in the email we sent you');
    }
    
    
    
    public function confirmRegister($confirmation_code, UserRepository $userRepository)
    {
        $userRepository->confirm($confirmation_code);

        return redirect('/')->with('ok', 'Registration success');
    }
    
    
    
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|max:100|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:18|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
