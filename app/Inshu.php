<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inshu extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $table = 'inshus';
  protected $fillable = [
    'user_id', 'date', 'kind', 'how', 'amount', 'count'
  ];
}
