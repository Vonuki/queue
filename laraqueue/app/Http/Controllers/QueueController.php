<?php

namespace App\Http\Controllers;

use App\Queue;
use App\Http\Controllers\Controller;

class QueueController extends Controller
{
  /**
   * All Queues
   *
   * @param  int  $id
   * @return Response
   */
  public function index()
  {
    $queues = Queue::all();
    return view('welcome', ['queues' => $queues]);
  }
}