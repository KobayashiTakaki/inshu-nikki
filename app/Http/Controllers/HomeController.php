<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inshu;
use Illuminate\Support\Facades\Auth;

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
     public function index(Request $request){
       /*
       $username = '';
       $user_id = '';
       $session_data = $request->session()->all();
       if (isset($session_data['username'])) {
         $username = $session_data['username'];
       }
       if (isset($session_data['user_id'])) {
         $user_id = $session_data['user_id'];
       }
       */

       //$inshus = [];


       //var_dump($inshu_sum);



       return view('home');
     }


}
