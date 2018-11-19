<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use Image;
class UserController extends Controller
{

    private $path = 'user';

    public function editUserAsUser(Request $request)
    {
        $validator = $this->validator($request->all());
        if($validator->passes())
        {
            $userMail = $request->input('email');
            $user = User::where('email',$userMail)->firstOrFail();
            $user->name = $request->input('name');
            $user->telefono = $request->input('telefono');
            $user->direccion = $request->input('direccion');
            $user->genero = $request->input('genero');
            if($request->hasFile('avatar-file'))
            {
                $userAvatar = $user->avatar;
                if($userAvatar === '/img/avatars/male.png' || $userAvatar === '/img/avatars/female.png')
                {
                    $avatar = $request->file('avatar-file');
                    $filename = time() . '.' . $avatar->getClientOriginalExtension();
                    Image::make($avatar)->resize(300,300)->save(public_path('/img/avatars/'.$filename));
                    $user->avatar = '/img/avatars/'.$filename;
                    
                }else
                {
                    Storage::delete('public/img/avatars/1540092587.png');
                    $avatar = $request->file('avatar-file');
                    $filename = time() . '.' . $avatar->getClientOriginalExtension();
                    Image::make($avatar)->resize(300,300)->save(public_path('/img/avatars/'.$filename));
                    $user->avatar = '/img/avatars/'.$filename;
                }
            }
            $user->save();
           
        }
        return view('user.profile')->with(['success' => '¡Usuario Editado Exitosamente!']);
    }
    public function editPasswordAsUser(Request $request)
    {
        $validator = $this->validateEditPassword($request->all());
        if($validator->passes())
        {
           $user = Auth::user(); 
           $newPassword = $request->input('password');
           $user->password = Hash::make($newPassword);
           $user->save();

           return view('user.profile')->with('success', '¡Usuario Editado Exitosamente!');  
        }else
        {
            return redirect()->back()->with('errors',$validator->errors());
        }
    }
    protected function validateEditPassword(array $data)
    {
        return Validator::make($data,[
            'password' => 'required|string|min:6|confirmed',
        ]);
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
            'telefono' => 'required',
            'direccion' => 'required',
            'genero'=> 'required', 
        ]);
    } 
    

    public function returnEditUserAsUserView()
    {
        return view('user.editUser');
    }



    public function editar1()
    {
        return view('administrador.editarUser');
    }


    public function returnEditPasswordAsUserView()
    {
        return view('user.editUserPassword');
    }

    public function returnProfileView()
    {
        return view('user.profile');
    }

    public function returnProfileView1()
    {
        return view('administrador.Rud_usuario');
    }


    public function index()
    {
    $users = User::orderBy('id', 'DESC')->paginate(5);
    return view('administrador.Rud_usuario',compact('users'));
   
    }

   


 public function eliminar($id)
 {

    
        $dato = User::destroy($id);
        $users = User::all();
        return view('administrador.Rud_usuario',compact('users'));
 


    
 }

    public function edit ($id)
        {
            $user = User::find($id);
            return view('administrador.editarUser')->with('user', $user); 
       
        }


        public function update(Request $request, $id)   
         {  
            $user = User::find($id);           
            $user -> name = $request->name;
            $user -> email = $request->email;
            $user -> esta_activo = $request->activo;
          
            $user -> telefono = $request->telefono;
            $user -> direccion = $request->direccion;
            $user -> genero = $request->genero;

            if($request->hasFile('avatar-file'))
            {
                $userAvatar = $user->avatar;
                
                    $avatar = $request->file('avatar-file');
                    $filename = time() . '.' . $avatar->getClientOriginalExtension();
                    Image::make($avatar)->resize(300,300)->save(public_path('/img/avatars/'.$filename));
                    $user->avatar = '/img/avatars/'.$filename;
                    
            }
            $user -> save();
            $users = User::all();
            return view('administrador.Rud_usuario',compact('users'));
            
        }

        public function buscarUsuario(Request $request)
{
    $busqueda = $request->input('search');
    $users = User::where('name','like','%'.$busqueda.'%')
    ->orWhere('email','like','%'.$busqueda.'%')->get();
    return view('administrador.Rud_usuario',compact('users'));
}

     
        

}
 


