   
@extends('layouts.app')
@section('content')
    <div class="bg-light p-2 mt-2">
       <h3> Hi Welcome!
        <p class="text-right"> Total Posts - {{$posts->count()}} </p></h3></div>
        <div class="bg-light p-2 mt-2 text-right">
            <a href="{{route('posts.index')}}">
                <button class="btn btn-info btn-sm shadow-none" type="button">Back</button></p>
            </a>
        </div>
            <form action="{{$route}}" method="POST">
            @csrf
            <form class="form-horizontal" role="form" method="POST" action="{{ $route }}">
                {{ csrf_field() }}
                @if (@$model['id'])
                    <input type="hidden" name="_method" value="PUT">
                    <input name="id" type="hidden" value="{{@$model['id']}}" ></>
                @endif
                <div id="" class="bg-light p-2" data-parent="#myGroup">
                    <div class="d-flex flex-row align-items-start mt-2">
                        <input name="user_name" type="text" value="{{@$model['user_name']}}" class="form-control ml-1 shadow-none" placeholder="Enter User Name"></>
                    </div>
                    <div class="d-flex flex-row align-items-start mt-2">
                        <input name="title" type="text" value="{{@$model['title']}}" class="form-control ml-1 shadow-none" placeholder="Enter Title"></>
                    </div>
                    <div class="d-flex flex-row align-items-start mt-2">
                        <textarea name="description"  class="form-control ml-1 shadow-none" placeholder="Enter Description">{{@$model['description']}}</textarea>
                    </div>
                    <div class="mt-2 text-right">
                        <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                        <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                    </div>
                </div>
            </form>
    @include('posts.show')
@endsection
