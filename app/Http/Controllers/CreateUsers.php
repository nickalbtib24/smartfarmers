<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;
use Image;

class CreateUsers extends Controller
{

    public function returnNewUserPage()
    {
        $roles=Role::orderBy('name')->pluck('name','id');
        return view('administrador/newUser',compact('roles'));
    
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

    public function newUser(Request $request)
    {
        $validator = $this->validator($request->all())->validate();
        
        
        if($request->hasFile('avatar-file'))
        {
            $avatar = $request->file('avatar-file');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(public_path('/img/avatars/'.$filename));
            $this->create($request->all(),'/img/avatars/'.$filename);
        } else
        {
            $genero = $request->input('genero');
            $filename='';
            if($genero === 'Masculino')
            {
                $filename ='/img/avatars/male.png';
            } else
            {
                $filename ='/img/avatars/female.png';
            }
            
            $this->create($request->all(),$filename);
        }
        return redirect()->back()->with('message', '¡Usuario Registrado Exitosamente!');

       
    }
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'telefono' => 'required',
            'direccion' => 'required',
            'role' => 'required',
        ]);

        
    }

    public function create(array $data, $filename)
    {
        

        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $filename,
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'genero' => $data['genero'],
            
        ]);

        $user->roles()->attach($data['role']);
        $user->save();
    }

    
}
