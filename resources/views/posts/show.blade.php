@foreach ($posts as $key => $post)
    <div class="d-flex flex-column comment-section" id="myGroup">
        <div class="bg-white p-2">
            <div class="d-flex flex-row user-info">
                <p data-letters="{{ucfirst(substr($post->user_name, 0, 1))}}"></p>
                <div class="d-flex flex-column justify-content-start ml-2">
                    <span class="d-block font-weight-bold name">{{$post->user_name}}</span>
                    <span class="date text-black-50">Shared publicly - {{$post->created_at->diffForHumans()}}</span></div>
                </div>
                <div class="d-flex flex-row align-items-start pull-right">
                    <a href="{{route('posts.edit', @$post->id)}}">
                        <button type="button" class="btn btn-info sm">
                            <i class="fa fa-edit"></i>
                        </button>
                    </a>&nbsp;&nbsp;
                    <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>

                <div class="mt-2">
                    <h5>{{$post->title}}</h5>
                    <p class="comment-text">{{$post->description}}</p>
                </div>
            </div>
            <div class="bg-white p-2">
                <div class="d-flex flex-row fs-12">
                    <div class="like p-2 cursor action-collapse" data-toggle="collapse" aria-expanded="true" aria-controls="collapse-{{$post->id}}" href="#collapse-{{$post->id}}">
                        <i class="fa fa-commenting-o"></i><span class="ml-1">Comment ({{$post->comments->count()}})</span></div>
                </div>
            </div>
        </div>  

    @include('comments.partials.form')

@endforeach
@if ($posts->count() == 0)
<div class="d-flex flex-column comment-section" id="myGroup">
    <div class="bg-white p-2 text-center">
    <h4>No Posts</h4>
    </div>
</div>
@endif