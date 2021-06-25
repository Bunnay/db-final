@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
        <form action="{{ route('tasks.update', $task->id) }}" method="post" class="form-horizontal">
            {{ csrf_field() }}
            @method('put')
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">ToDo App</label>
                <div class="col-sm-6">
                    <input type="text" name="task_name" id="task-name" class="form-control" value='{{$task->task_name}}'>
                </div>
                <div class="col-sm-6">
                    <select required class="form-control form-control-user" name="status">
                        <option value="{{$task->status}}">{{$task->status}}</option>
                        @if($task->status == 'private')
                            <option value="public">public</option>
                        @endif
                        @if($task->status == 'public')
                        <option value="private">private</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
