@extends('layouts.app')

@section('content')
  <div class="panel-body">
  

    <!-- Форма новой задачи -->
    <form action="{{ url('queue') }}" method="POST" class="form-horizontal">
      {{ csrf_field() }}

      <!-- Имя задачи -->
      <div class="form-group">
        <label for="task" class="col-sm-3 control-label"> {{$queue->Description}} </label>

        <div class="col-sm-6">
          <input type="text" name="idQueue" id="queue-id" class="form-control" value="{{$queue->idQueue}}">
          <input type="text" name="Description" id="queue-description" class="form-control" value="{{ $queue->Description }}">
        </div>
      </div>

      <!-- Кнопка добавления задачи -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> Добавить очередь
          </button>
        </div>
      </div>
    </form>
  </div>
@endsection