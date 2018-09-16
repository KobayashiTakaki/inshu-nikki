<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    //
    protected $table = 'Drinks';
    protected $fillable = [
      'kind',
      'kindDisp',
      'how',
      'howDisp',
      'amount',
    ];

}
