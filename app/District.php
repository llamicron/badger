<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model {

  protected $fillable = [
    'name',
  ];

  public function counselors() {
    return $this->hasMany(Counselor::class);
  }
}
