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
                ->orderBy('date')
                ->get();
      return $inshus;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
  
  public function apiTest(Request $request)
  {
    $type = $request->type;
    switch($type)
    {
      case 'A':
        return [
          ['id'=> 1, 'date'=> '2018/09/01', 'kind' => 'あ', 'amount'=> 100],
          ['id'=> 2, 'date'=> '2018/09/02', 'kind' => 'い', 'amount'=> 110],
          ['id'=> 3, 'date'=> '2018/09/03', 'kind' => 'う', 'amount'=> 120],
        ];
        break;
      case 'B':
        return [
          ['id'=> 4, 'date'=> '2018/10/01', 'kind' => 'え', 'amount'=> 200],
          ['id'=> 5, 'date'=> '2018/10/02', 'kind' => 'お', 'amount'=> 210],
        ];
        break;
      return 'invalid param.';
    }
  }

}
