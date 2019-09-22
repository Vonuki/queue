<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $table = 'Queue';
    public $timestamps = false;
    protected $primaryKey = 'idQueue';
  
    public function Owner()
    {
      return $this->belongsTo(Owner::class);
    }
}
