@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mt-5 mb-5">
        <h2>Users</h2>
        <a href="{{route('home')}}"><button class="btn btn-info">Home</button></a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mb-4 pb-0">
            <p>{{ $message }}</p>
        </div>
    @endif

        <div class="row mb-5">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <form action="{{ route('users.index')}}" class="d-flex">
                        <input type="text" name="search" id="search" class="form-control mr-2" placeholder="Search..." value="{{request()->get('search')}}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <div>{{$user->id}}</div>
                    </td>
                    <td>
                        <div>{{$user->name}}</div>
                    </td>
                    <td>
                        <div>{{$user->email}}</div>
                    </td>
                    <td>
                        <div>{{$user->created_at}}</div>
                    </td>
                    <td>
                        <div>{{$user->updated_at}}</div>
                    </td>
                </tr>
            @endforeach
    </table>

</div>
@endsection
