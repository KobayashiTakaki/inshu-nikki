<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alc_amount extends Model
{
    //
    protected $table = 'alc_amount';
    protected $fillable = [
      'kind', 'how', 'alc_amount'
    ];

}
