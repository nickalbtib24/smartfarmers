<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Catalogo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use DB;
use Mail;
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
    protected $redirectTo = '/home';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'telefono' => 'required',
            'direccion' => 'required',
            'genero' => 'required',
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
        
        $role=Role::where('name', 'CompradorVendedor')->first();

        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'genero' => $data['genero'],
        ]);
        if($data['genero'] == 'Masculino')
        {
            $user->avatar = '/img/avatars/male.png';
        } 
        elseif($data['genero'] == 'Femenino')
        {
            $user->avatar = '/img/avatars/female.png';
        }
        $user->roles()->attach($role);
        $user->save();
        $catalogo = new Catalogo;
        $catalogo->user_name = $user->name;
        $catalogo->user()->associate($user);
        $catalogo->save();
        return $user;
      
    }

    public function register(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);
        if($validator->passes())
        {
            $user = $this->create($input)->toArray();
            $user['link'] = str_random(30);

            DB::table('users_activations')->insert([
                'user_id' => $user['id'],
                'token' => $user['link'],
            ]);
            Mail::send('mail.activacion',$user, function($message) use ($user)
            {
                $message->to($user['email']);
                $message->subject('SMART-FARMERS  Activación de cuenta');
            });
            return redirect()->to('login')->with('success',"Se le ha enviado un código de activación, por favor revise su correo electrónico");
        }else
        {
            return redirect()->back()->with('errors',$validator->errors('errors','quihubo'));
        }
    }

    public function activateUser(String $token)
    {
        $activacion = DB::table('users_activations')->where('token',$token)->first();
        if(!is_null($activacion))
        {
            $user = User::find($activacion->user_id);
            if($user->esta_activo == 1)
            {
                return redirect()->to('login')->with('success',"El usuaro ya ha sido activado");
            }
            $user->update(['esta_activo' => 1]);
            DB::table('users_activations')->where('token',$token)->delete();
            return redirect()->to('login')->with('success','Su usuario se activó satisfactoriamente');
        }
       return redirect()->to('login')->with('warning',"Su token de activación es inválido");
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
}
