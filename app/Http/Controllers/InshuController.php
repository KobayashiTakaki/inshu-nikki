<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Inshu;

class InshuController extends Controller
{
  protected $table = 'inshu';

  public function post(Request $request){
    session(['user_id' => '1'])
    $user_id = $request->session()
    $inshu = new Inshu();
    $inshu->
  }
