@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="container p-3 bg-secondary">
        <form action="{{route('tasks.store')}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label text-white"><h1>Todolist</h1></label>
                <div class="row pl-4">
                    <div class="col-sm-6">
                        <input type="text" name="task_name" id="task-name" class="form-control" placeholder="Text..." required>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group d-flex">
                            <button type="submit" class="btn btn-primary mr-2">Add</button>
                            <select required class="form-control form-control-user w-25 mr-2" name="status">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                            <select required class="form-control form-control-user w-25" name="category_ids[]" id="category_ids" size="1" multiple="multiple">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
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
                <form class="d-flex w-75">
                    <select class="form-control form-control-user mr-2" name="status" id="status">
                        <option value="" selected>Select Status</option>
                        <option value="public" {{ request()->query('status') === 'public' ? 'selected' : '' }}>Public</option>
                        <option value="private" {{ request()->query('status') === 'private' ? 'selected' : '' }}>Private</option>
                    </select>

                    <select class="form-control form-control-user mr-2" name="user_id" id="user_id">
                        <option value="" selected>Select User Name</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" {{request()->query('user_id') === $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success mr-2">Search</button>
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
                                <th>Categories</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    @can('view', $task)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $task->task_name }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $task->user->name }}</div>
                                        </td>
                                        <td>
                                            @foreach ($task->categories as $category)
                                                <div>{{$category->name}}</div>
                                             @endforeach
                                        </td>
                                        <td>
                                            <p>{{$task->status}}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around w-25 mr-4">
                                                @can('update', $task)
                                                    <a class="btn btn-primary btn-sm mr-2" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
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
