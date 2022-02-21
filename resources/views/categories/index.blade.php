@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mt-5 mb-5">
        <h2>Categories</h2>
        <a href="{{route('home')}}"><button class="btn btn-info">Home</button></a>
        <a href="{{ route('categories.create') }}"><button class="btn btn-success">Create New Category</button></a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mb-4 pb-0">
            <p>{{ $message }}</p>
        </div>
    @endif

        <div class="row mb-5">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <form action="{{ route('categories.index')}}" class="d-flex">
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
            <th>Created</th>
            <th>Updated</th>
            <th>Action</th>
        </tr>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        <div>{{$category->id}}</div>
                    </td>
                    <td>
                        <div>{{$category->name}}</div>
                    </td>
                    <td>
                        <div>{{$category->created_at}}</div>
                    </td>
                    <td>
                        <div>{{$category->updated_at}}</div>
                    </td>
                    <td>
                        <form action="{{ route('categories.destroy',$category->id)}}" method="POST" class='m-0'>
                            <a class="btn btn-warning" href="{{ route('categories.edit',$category->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </table>

</div>
@endsection
