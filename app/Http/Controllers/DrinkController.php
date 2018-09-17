<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Drink;
use Illuminate\Http\Response;

class DrinkController extends Controller
{
    //
    public function getDrinks(Request $request)
    {
      try
      {
        $drinks = Drink::get();
        return $drinks;
      }
      catch (Exception $e)
      {
        return $e->getMessage();
      }
    }
    public function getKinds(Request $request)
    {
      try
      {
        $kinds = Drink::select('kind','kindDisp')->distinct()->get();
        return $kinds;
      }
      catch (Exception $e)
      {
        return $e->getMessage();
      }
    }

    public function getHows(Request $request)
    {
      try
      {
        $hows = Drink::where('kind', $request->kind)->select('how','howDisp')->distinct()->get();
        return $hows;
      }
      catch (Exception $e)
      {
        return $e->getMessage();
      }
    }
}
