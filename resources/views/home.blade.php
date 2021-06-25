@extends('layouts.app')

@section('content')
   <div class="container">
       <h2>Welcome To ToDo Application</h2>

       @unless (Auth::check())
            You are not login.
        @endunless

        @if(Auth::check())
            <ul>
                <li><a href="{{route('tasks')}}">ToDo App</a></li>
            </ul>
        @endif
    </div>
@endsection
