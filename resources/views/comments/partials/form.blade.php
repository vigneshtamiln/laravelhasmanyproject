<div id="collapse-{{$post->id}}" class="bg-light p-2 collapse" data-parent="#myGroup">
    <form class="commentForm" method="POST">
        {{ csrf_field() }}
        @if (@$model['id'])
            <input type="hidden" name="_method" value="PUT">
            <input name="id" type="hidden" value="{{@$model['id']}}" ></>
        @endif
        <input name="post_id" type="hidden" value="{{@$post['id']}}" ></>

            <div class="d-flex flex-row align-items-start mt-2">
                <input name="user_name" type="text" value="{{@$model['user_name']}}" id="user_name" class="form-control ml-1 shadow-none user_name" placeholder="Enter User Name"></>
            </div>
            <div class="d-flex flex-row align-items-start mt-2">
                <textarea name="description"  class="form-control ml-1 shadow-none description" id="description" placeholder="Enter Description">{{@$model['description']}}</textarea>
            </div>
            <div class="mt-2 text-right">
                <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
            </div>
    </form>
<div class="d-flex flex-row align-items-start">
</div>
   @include('comments.show')

  @push('scripts')
  <script>
        $( document ).ready(function() {
            $(".commentForm").attr('action', "{{route('comments.store')}}");

          $('body').on('click', '.editButton', function(){
               var id = $(this).data('id');
               var Url = $(this).data('route');
               $.ajax({
            method: "GET",
            url: Url,
            data: { id: id }
            })
            .done(function( response ) {
                $('.commentForm').removeAttr('action')
                $("<input>").attr({
                name: "_method",
                id: "hiddenId",
                type: "hidden",
                value: 'PUT'
            }).appendTo(".commentForm");
                $(".commentForm").attr('action', response.route);
                $(".user_name").val(response.data.user_name);
                $(".description").val(response.data.description);
            });
          });
    //       var id = '1';
    //     
      });
  </script>
  @endpush 