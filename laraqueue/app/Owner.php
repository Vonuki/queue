<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $table = 'Owner';
    public $timestamps = false;
  
    public function Queues()
    {
      return $this->hasMany(Queue::class);
    }
}
