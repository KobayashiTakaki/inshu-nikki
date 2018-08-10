<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    /**
     * 指定ユーザーのプロフィール表示
     *
     * @param  int  $id
     * @return Response
     */
    public function post($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
}
