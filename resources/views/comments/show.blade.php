@foreach ($post->comments as $key => $comment)
<div class="d-flex flex-column comment-section" id="myGroup">
    <div class="bg-white p-2">
        <div class="d-flex flex-row user-info">
            <p data-letters="{{ucfirst(substr($comment->user_name, 0, 1))}}"></p>
            <div class="d-flex flex-column justify-content-start ml-2">
                <span class="d-block font-weight-bold name">{{$comment->user_name}}</span>
                <span class="date text-black-50">Shared publicly - {{$comment->created_at->diffForHumans()}}</span></div>
            </div>
            <div class="d-flex flex-row align-items-start pull-right">
                <button type="button" data-route={{route('comments.edit', $comment['id'])}} data-id={{$comment['id']}} class="btn btn-info sm editButton" id="editButton-{{$comment['id']}}">
                    <i class="fa fa-edit"></i>
                </button>
                &nbsp;&nbsp;
                <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger sm">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </div>
            <div class="mt-2">
                <p class="comment-text">{{$comment->description}}</p>
            </div>
        </div>
    </div>
@endforeach 
</div>
