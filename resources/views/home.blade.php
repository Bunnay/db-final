@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="container-fluid bgimg" style="height: 734px;">
            <div class="text-center">
            <h1 class="title" style="paddingTop: 30px">Welcome To Todolist</h1>
        </div>
            <div class="container d-flex mt-5">
            <div class="card mr-3" style="width:400px">
                <img class="card-img-top" src="{{asset('/images/todo.jpg')}}" alt="Card image" style="width:100%;height:300px">
                <div class="card-body">
                <h4 class="card-title">Todolist</h4>
                <a href="{{route('tasks')}}" class="btn btn-primary w-100">Go</a>
                </div>
            </div>
            <div class="card mr-3" style="width:400px">
                <img class="card-img-top" src="{{asset('/images/category.jpg')}}" alt="Card image" style="width:100%;height:300px">
                <div class="card-body">
                <h4 class="card-title">Categories</h4>
                <a href="{{route('categories.index')}}" class="btn btn-primary w-100">Go</a>
                </div>
            </div>
            <div class="card" style="width:400px">
                <img class="card-img-top" src="{{asset('/images/user.jpg')}}" alt="Card image" style="width:100%;height:300px">
                <div class="card-body">
                <h4 class="card-title">Users</h4>
                <a href="{{route('users.index')}}" class="btn btn-primary w-100">Go</a>
                </div>
            </div>
        </div>
    @endif

    @unless (Auth::check())
    <div class="d-flex justify-content-center mt-5">
        <div class="card mr-3" style="width:400px">
            <div class="card-body">
            <h4 class="card-title">Todolist</h4>
            <p class="card-text">You are not login!</p>
            <a href="{{ route('login') }}" class="btn btn-primary w-100">{{ __('Login') }}</a>
            </div>
        </div></div>
    @endunless

    </div>
@endsection
