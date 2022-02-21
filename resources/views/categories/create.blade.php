@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mt-5 mb-5">
        <h2>Add New Category</h2>
        <a href="{{ route('categories.index') }}"><button class="btn btn-success">Back</button></a>
    </div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
</div>
@endsection
