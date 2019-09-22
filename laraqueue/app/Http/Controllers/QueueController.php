<?php

namespace App\Http\Controllers;

use App\Queue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    return view('queues', ['queues' => $queues]);
  }
  
  public function edit(Queue $queue)
  {
    $queues = Queue::all();
    return view('queue', ['queue' => $queue]);
  }
  
  public function save(Request $request)
  {
    $queue = Queue::find($request->idQueue);  
    $queue->Description = $request->Description;
    $queue->save();

    return redirect('/queues');
  }
}