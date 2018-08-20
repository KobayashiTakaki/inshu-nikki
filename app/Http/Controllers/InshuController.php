<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Inshu;
use App\alc_amount;
use App\Http\Resources\InshuCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

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
    $count = $request->input('count');
    if(null === $count){
      $count = 1;
    }

    $amount = alc_amount::where('kind', $request->input('kind'))->where('how', $request->input('how'))
                    ->first()
                    ->amount;

    $inshu = new Inshu();
    $inshu->user_id = Auth::id();
    $inshu->date = $request->input('date');
    $inshu->kind = $request->input('kind');
    $inshu->how = $request->input('how');
    $inshu->amount = $amount;
    $inshu->count = $count;
    $inshu->save();

    return redirect('/');
  }

  public function showTotal(Request $request) {

    $inshus = Inshu::where('user_id', Auth::id())->get();
    $inshu_sum =[];
    $kinds = $inshus->unique('kind')->pluck('kind');

    if ($kinds !== null) {
      foreach ($kinds as $kind) {
        $amount_sum = $inshus->where('kind', $kind)->sum('amount');
        array_push($inshu_sum, ['kind' => $kind, 'amount' => $amount_sum]);
      }

      foreach ((array) $inshu_sum as $key => $value) {
        $sort[$key] = $value['amount'];
      }

      array_multisort($sort, SORT_DESC, $inshu_sum);
    }
    return $inshu_sum;

    //return new InshuCollection(Inshu::where('user_id', $user_id));
  }

}
