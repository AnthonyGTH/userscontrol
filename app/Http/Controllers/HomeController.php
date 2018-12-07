<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::all();
      return view('home', compact('users'));//Listado
    }
    public function createform()
    {

      return view('usuarios\create');//formulario para crear
    }
    public function store(Request $req)
    {

      //$array = (array) $req;
      $user = User::create([
          'name' => $req->input('name'),
          'email' => $req->input('email'),
          'password' => bcrypt($req->input('password')),
      ]);

      if($req->input('rol')=="1"){
        $user
            ->roles()
            ->attach(Role::where('name', 'admin')->first());
      }else{
        $user
            ->roles()
            ->attach(Role::where('name', 'user')->first());
      }
        $users = User::all();
        return view('home',compact('users'));

    }

    public function preEdit($id){

        $user = User::where('id',$id)->first();

        $rol = DB::select("SELECT role_id FROM role_user WHERE user_id = $id");//Conseguir id del rol actual
        $idRol = (array) $rol[0];
        $idRolS = $idRol['role_id'];
        //print_r($idRol['role_id']);
        return view('usuarios\edit', compact('user','idRolS'));//activar vista de edicion y envio de arreglo de datos del usuario y id del rol
    }

    public function edit(Request $request, $id)
    {
      $user=User::find($id);
      if(($request->input('name'))!=""){
        $user->name=$request->input('name');
      }
      if(($request->input('email'))!=""){
        $user->email=$request->input('email');
      }
      if(($request->input('password'))!=""){
        $user->password=Hash::make($request->input('password'));
      }



      $user->save();
      DB::delete("DELETE FROM role_user WHERE user_id = $id");//eliminacion de los anteriores roles del usuario
      if($request->input('rol')=="1"){

        $user
            ->roles()
            ->attach(Role::where('name', 'admin')->first());
      }else{
        $user
            ->roles()
            ->attach(Role::where('name', 'user')->first());
      }
      $users = User::all();
      return view('home', compact('users'));

    }

    public function delete($id)
    {

      User::destroy($id);
      DB::delete("DELETE FROM role_user WHERE user_id = $id");//eliminacion de los roles del usuario a eliminar
      $users = User::all();
      return view('home', compact('users'));
    }
}
