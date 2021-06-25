@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container p-3 bg-secondary">
        <form action="{{route('tasks.store')}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label text-white"><h1>ToDo App</h1></label>
                <div class="row pl-4">
                    <div class="col-sm-6">
                        <input type="text" name="task_name" id="task-name" class="form-control" placeholder="Text..." required>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group d-flex">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <select required class="form-control form-control-user w-25" name="status">
                                <option value="">Select Status</option>
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card p-2">
        <div class="card-header">
            <div class="container d-flex justify-content-center">
                <form class="d-flex">
                    <select class="form-control form-control-user" name="status" id="status">
                        <option value="" selected>--Select Status--</option>
                        @foreach($statuses as $status)
                            <option value="{{$status}}" {{ $status == $selected_id['status'] ? 'selected' : '' }}>{{$status}}</option>
                        @endforeach
                    </select>

                    <select class="form-control form-control-user" name="user_id" id="user_id">
                        <option value="" selected>--Select User Name--</option>
                        @foreach($user_names as $name)
                            <option value="{{$name->user_id}}" {{ $name->user_id == $selected_id['user_id'] ? 'selected' : '' }}>{{$name->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success">Search</button>
                </form>
                @if(Request::query('status') || Request::query('user_id'))
                    <a href="{{route('tasks')}}"><button class="btn btn-danger">Clear Search</button></a>
                @endif
            </div>
        </div>

        <div class="card-body">
            @if(count($tasks) > 0 && Auth::check())
                <div class="panel panel-default">
                    <div class="panel-heading d-flex">
                        <h3 class="m-2">ToDo List</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Task</th>
                                <th>User Name</th>
                                <th>Edit | Delete</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    @can('view', $task)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $task->task_name }}</div>
                                        </td>
                                        <td>
                                            <div>{{$task->user->name}}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around w-25 mr-4">
                                                @can('update', $task)
                                                    <a class="btn btn-primary btn-sm" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                                                @endcan
                                                @can('delete', $task)
                                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                @endcan
                                            </form>
                                            </div>
                                        </td>
                                        <td>
                                            <p>{{$task->status}}</p>
                                        </td>
                                    </tr>
                                    @endcan
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
