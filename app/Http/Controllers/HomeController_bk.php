<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inshu;

class HomeController extends Controller
{
    //
    public function show(Request $request){
      $username = '';
      $user_id = '';
      $session_data = $request->session()->all();
      if (isset($session_data['username'])) {
        $username = $session_data['username'];
      }
      if (isset($session_data['user_id'])) {
        $user_id = $session_data['user_id'];
      }

      //$inshus = [];

      $inshus = Inshu::where('user_id', $user_id)
                ->get();
      //var_dump($kinds);
      /*
      foreach ($kinds as $kind) {
         $amount = Inshu::where('user_id', $user_id)
                    ->where('kind', $kind)
                    ->sum('amount');
        $inshus[$kind] = $amount;
      }
      */
      $inshu_sum =[];
      $kinds = $inshus->unique('kind')->pluck('kind');
      foreach ($kinds as $kind) {
        $amount_sum = $inshus->where('kind', $kind)->sum('amount');
        array_push($inshu_sum, ['kind' => $kind, 'amount' => $amount_sum]);
      }

      //var_dump($inshu_sum);



      return view('home', compact('username','user_id', 'inshu_sum'));
    }
}
