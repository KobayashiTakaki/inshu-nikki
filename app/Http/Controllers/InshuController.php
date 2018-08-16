<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Inshu;
use App\alc_amount;
use App\Http\Resources\InshuCollection;

class InshuController extends Controller
{
  /*
  private function calcAlcAmount($kind, $how){
    $alc_amount = alc_amount::where('kind', $kind)->where('how', $how)
                  ->get();
    return $alc_amount->alc_amount;
  }
  */

  public function post(Request $request){
    $kind;
    $how;
    $count;

    $session_data = $request->session()->all();
    if(!isset($session_data['user_id'])){
      $request->session()->flash('message', 'ログインが必要です');
    }

    $kind = $request->input('kind');
    $how = $request->input('how');
    $count = $request->input('count');

    if(null === $count){
      $count = 1;
    }

    $amount = alc_amount::where('kind', $kind)->where('how', $how)
                    ->first()
                    ->amount;

    for ($i = 0; $i < $count; $i++){
      $inshu = new Inshu();
      $inshu->user_id = $session_data['user_id'];
      $inshu->date =$request->input('date');
      $inshu->kind = $kind;
      $inshu->how = $how;
      $inshu->amount = $amount;
      $inshu->save();
    }

    return redirect('/');
  }

  public function showTotal(Request $request) {
    //$user = Auth::user();
    //$user_id = session('user_id');

    return Inshu::all();
    //return new InshuCollection(Inshu::where('user_id', $user_id));
  }

}
