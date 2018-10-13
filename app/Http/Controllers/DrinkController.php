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
    public function index(Request $request)
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
}
