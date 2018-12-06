<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

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
      $users = User::all();
      $array = (array) $req;
      return view('home',compact('users'));
      User::create([
          'name' => $array['name'],
          'email' => $array['email'],
          'password' => Hash::make($array['password']),
      ]);

        return view('home',compact('users'));

    }

    public function preEdit($id)
    {

        $user = User::where('id',$id)->first();
        return view('usuarios\edit', compact('user'));
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
      $users = User::all();
      return view('home', compact('users'));

    }

    public function delete($id)
    {

      User::destroy($id);
      $users = User::all();
      return view('home', compact('users'));
    }
}
