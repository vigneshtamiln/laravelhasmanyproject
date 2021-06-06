@extends('layouts.app')
@section('content')
    <div class="bg-light p-2 mt-2">
       <h3 class="text-center"> Hi Welcome!</h3>
        <h4><p class="text-right"> Total Posts - {{$posts->count()}} </p></h4></div>
        <div class="bg-light p-2 mt-2 text-right">
            <a href="{{route('posts.create')}}"><button class="btn btn-primary btn-sm shadow-none" type="button">Create Post</button></p></a>
        </div>
        @include('posts.show')
@endsection
