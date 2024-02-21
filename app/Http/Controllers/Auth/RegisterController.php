<?php

namespace App\Http\Controllers\Auth;

use App\CategorySub;
use App\Http\Controllers\Controller;
use App\Mail\RegisteredUser;
use App\NgLga;
use App\NgState;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:25',
            'lname' => 'required|string|max:25',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|min:11|max:14',
            'address' => 'required',
            'state' => 'required',
            'lga' => 'required',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'phone' =>$data['phone'],
            'address' => $data['address'],
            'state' => $data['state'],
            'lga' => $data['lga'],
            'password' => Hash::make($data['password']),
        ]);
    }

         /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $allSubCategories = CategorySub::all();
        session()->put('previousUrl', url()->previous());

        //for state and lg
        $states = NgState::all();
        $lgas = NgLga::all();

        return view('auth.register')->with([
            'allSubCategories' => $allSubCategories,
            'states' => $states,
            'lgas' => $lgas,
        ]);
    }

    public function redirectTo()
        {
            return str_replace(url('/'), '', session()->get('previousUrl', '/'));
        }
}
