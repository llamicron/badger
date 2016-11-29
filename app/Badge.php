<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = [
      'name',
      'code',
    ];

    public function counselors() {
      return $this->belongsToMany(Counselor::class);
    }
}
