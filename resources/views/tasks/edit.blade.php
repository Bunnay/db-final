@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="container">
        <label for="task-name" class="col-sm-3 control-label"><h1>Edit Todolist</h1></label>
        <form action="{{ route('tasks.update', $task->id) }}" method="post" class="form-horizontal">
            {{ csrf_field() }}
            @method('put')
            <div class="form-group">


                <label for="task-name" class="col-sm-3 control-label">Task Name</label>
                <div class="col-sm-6 mb-2">
                    <input type="text" name="task_name" id="task-name" class="form-control" value='{{$task->task_name}}'>
                </div>

                <label for="status" class="col-sm-3 control-label">Status</label>
                <div class="col-sm-6 mb-2">
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

                <label for="categories" class="col-sm-3 control-label">Categories</label>
                <div class="col-sm-6 mb-2">
                    <select required class="form-control form-control-user w-25" name="category_ids[]" id="category_ids" multiple="multiple">
                        @if($task->category_ids)
                            <option value="{{$task->category_ids}}" selected>{{$task->category_ids}}</option>
                        @else
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
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
