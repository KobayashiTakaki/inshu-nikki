<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    //
    public function show(Request $request) {
      $session_data = $request->session()->all();
      $msg = ['name' => var_dump($session_data)];
      return view('user', $msg);
    }

    public function register(Request $request) {
      $user = new User();
      $user->fill($request->all())->save();

      $msg = ['name' => $request->input('name')];
      return view('user', $msg);
    }
}
