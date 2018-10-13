<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Inshu;
use App\Drink;
use App\Http\Resources\InshuCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class InshuController extends Controller
{
  public function post(Request $request){
    $count = $request->input('count');
    if(null === $count)
    {
      $count = 1;
    }

    $amount = Drink::where('kind', $request->input('kind'))->where('how', $request->input('how'))
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

  public function index(Request $request) {
    try
    {
      $dateFrom = $request->dateFrom;
      $dateTo = $request->dateTo;
      $inshus = Inshu::where('user_id', Auth::id())
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->orderBy('date', 'desc')
                ->get();
      return $inshus;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

}
