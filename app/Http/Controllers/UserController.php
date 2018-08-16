<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    //
    public function show(Request $request) {
      $session_data = $request->session()->all();
      $message = var_dump($session_data);
      return view('user', compact('message'));
    }
    //
    public function register(Request $request) {
      $user = new User();
      $user->fill($request->all())->save();

      $email = $request->input('email');
      $user = User::where('email', $email)->first();

      Auth::loginUsingId($user->id);
      $request->session()->put('user_id',$user->id);
      $request->session()->put('username',$user->name);

      return redirect('/');
    }
    //
    public function login(Request $request) {

      $email = $request->input('email');
      $user = User::where('email', $email)->first();

      Auth::loginUsingId($user->id);
      $request->session()->put('user_id',$user->id);
      $request->session()->put('username',$user->name);

      return redirect('/');
    }

    public function logout(Request $request) {
      Auth::logout();
      $request->session()->flush();
      return redirect('/');
    }
}
