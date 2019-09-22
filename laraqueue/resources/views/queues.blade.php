@extends('layouts.app')

@section('content')

  <!-- Текущие задачи -->
  @if (count($queues) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Current Queue
      </div>

      <div class="panel-body">
        <table class="table table-striped task-table">

          <!-- Заголовок таблицы -->
          <thead>
            <th>Queue</th>
            <th>&nbsp;</th>
          </thead>

          <!-- Тело таблицы -->
          <tbody>
            @foreach ($queues as $queue)
              <tr>
                <!-- Имя задачи -->
                <td class="table-text">
                  <div>{{ $queue->Description }}</div>
                </td>

                <td>
                  <a href="{{ url('/queue/'.$queue->idQueue)}}">edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
   @endif
@endsection
