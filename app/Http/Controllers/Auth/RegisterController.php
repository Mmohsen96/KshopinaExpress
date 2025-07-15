<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

/*     protected $redirectTo = RouteServiceProvider::HOME;
 */
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function create(array $data)
    {
        if ($data['register_type'] == 1) {
            return User::create([
                'type' => 1,
                'active' => 0,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),

            ]);
        } else {
            return User::create([
                'type' => 0,
                'active' => 0,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),

            ]);
        }
    }

    protected function create_shipper_id($id)
    {
        $shipper_id = DB::table('shippers')->insertGetId(['user_id' => $id]);

        DB::table('kshopina.users')
            ->where('id', Auth::user()->id)
            ->update(['shipper_id' => $shipper_id]);
    }
    
    protected function add_shipper_info()
    {
        return view('shipper_info')->with('user', Auth::user());
    }
}
