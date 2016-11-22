<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counselor extends Model
{
  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'phone',
    'unit_num',
    'bsa_id',
    'unit_only',
    'ypt'
  ];

  public function user() {
    return $this->belongsTo('App\User');
  }
}
