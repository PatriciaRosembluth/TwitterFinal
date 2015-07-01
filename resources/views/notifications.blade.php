@extends('app')
@section('content')

        <div class="col-md-15 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading" align="center"><h3>Notifications</h3></div>
                 <div class="panel-body-p"><h3>{{$user->name}} </h3></div>
                    <div class="panel-heading"><h3>Reposted </h3>
            </div>  

    
    @foreach ($posts as $post)
    
        @foreach ($reposts as $repost)
             @if ($post->id == $repost->post_id)
            <div class="panel-body-c">
             <div class="panel-heading-r">
                Reposted from {{DB::table('users')->find($post->user_id)->name}}<br>
                {{$post->created_at->format('d-m-Y / h:m:s')}}
             </div>
             <div class="panel-body-r">
                <textarea class="form-control" rows="5" cols="380" disabled>{{$post->content}}</textarea>
                <ul class="list breadcrumbs small" style="padding-left: 0px;">
                    Likes: <li id="{{$post->id}}" value="{{$post->likes}}">{{$post->likes}}</li>
                    Reposts: <li class="{{$post->id}}" value="{{$post->reposts}}"> {{$post->reposts}}</li>
                    <li></li>
                    <br>
                    </li>
                </ul>
                <strong>Users:</strong>
                    <table>
                        <tr>
                @foreach ($users as $user)
                @if ($user->id == $repost->user_id)
                    <td>{{$user->user_name}} , </td>
                @endif
                @endforeach
                </tr>
            </table>

             </div>
            </div>
            <br>

             @endif
        @endforeach
    @endforeach

    <div class="panel-heading"><h3>Likes </h3>
            </div> 
             @foreach ($posts as $post)
    
        @foreach ($likes as $like)
             @if ($post->id == $like->post_id)
            <div class="panel-body-c">
             <div class="panel-heading-p">
                Post from {{DB::table('users')->find($post->user_id)->name}}<br>
                {{$post->created_at->format('d-m-Y / h:m:s')}}
             </div>
             <div class="panel-body-r">
                <textarea class="form-control" rows="5" cols="380" disabled>{{$post->content}}</textarea>
                <strong>Usuarios:</strong>
                <table>
                    <tr>
                @foreach ($users as $user)
                @if ($user->id == $like->user_id)
                    <td>{{$user->user_name}} , </td>
                @endif
                @endforeach
                </tr>
                </table>

             </div>
            </div>
            <br>

             @endif
        @endforeach
    @endforeach

    <div class="panel-heading"><h3>Replys </h3>
            </div> 
             @foreach ($posts as $post)
    
        @foreach ($replys as $reply)
             @if ($post->id == $reply->post_id)
            <div class="panel-body-c">
             <div class="panel-heading-p">
                Post from {{DB::table('users')->find($post->user_id)->name}}<br>
                {{$post->created_at->format('d-m-Y / h:m:s')}}
             </div>
             <div class="panel-body-r">
                <textarea class="form-control" rows="5" cols="380" disabled>{{$post->content}}</textarea>
                <strong>Usuarios:</strong>
                <table>
                    <tr>
                @foreach ($users as $user)
                @if ($user->id == $reply->user_id)
                    <td>{{$user->user_name}} , </td>
                @endif
                @endforeach
                </tr>
                </table>

             </div>
            </div>
            <br>

             @endif
        @endforeach
    @endforeach

@stop

{!! Form::open(['url'=>'post/like', 'id' => 'form-like']) !!}
{!!Form::close() !!}

{!! Form::open(['url'=>'post/deslike', 'id' => 'form-deslike']) !!}
{!!Form::close() !!}

{!! Form::open(['url'=>'user/follow', 'id' => 'form-follow']) !!}
{!!Form::close() !!}

{!! Form::open(['route' => 'posts.store', 'id' => 'form-post']) !!}
{!! Form::close() !!}

{!! Form::open(['url'=>'user/unfollow', 'id' => 'form-unfollow']) !!}
{!!Form::close() !!}

<script>
$(document).ready(function(){
       $('.user-follow').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            var form = $('#form-follow');
            var url = form.attr('action') + '/' + id;
            var data = form.serialize();
            
            $.post(url,data,function(follows){
                   $("#" + id).attr("value", follows);
                   $("#" + id).text(follows);
            });
            
            
       });


});;

$(document).ready(function(){
       $('.user-unfollow').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            var form = $('#form-unfollow');
            var url = form.attr('action') + '/' + id;
            var data = form.serialize();
            
            $.post(url,data,function(follows){
                   $("#" + id).attr("value", follows);
                   $("#" + id).text(follows);
            });
            
            
       });


});;

$(document).ready(function(){
       $('.repost').click(function(){
            var id = $(this).val();
            $.ajax({    
                     type:   "POST", 
                     url:    '/repost/' + id, 
                     data:   {}, 
                     success:    function(resp)   {   
                     $('#new-repost').prepend(resp);
                    }   
            }); 

           
       });


});

$(document).ready(function(){
       $('.like-post').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            var form = $('#form-like');
            var url = form.attr('action') + '/' + id;
            var data = form.serialize();
            
            $.post(url,data,function(likes){
                   $("#" + id).attr("value", likes);
                   $("#" + id).text(likes);
            });
       });


});

$(document).ready(  function(    )   {   
                $('.post').on(  'submit',   function(e)  {   
                                e.preventDefault(); 
                                var content =   $('#area').val();

                                $.ajax({    
                                                type:   "POST", 
                                                url:    '/posts', 
                                                data:   {content:content}, 
                                                success:    function(resp)   {   
                                                   $('#new-post').prepend(resp);
                                                }   
                                }); 
            
                }); 
});

$(document).ready(function(){
       $('.deslike-post').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            var form = $('#form-deslike');
            var url = form.attr('action') + '/' + id;
            var data = form.serialize();
            
            $.post(url,data,function(likes){
                   $("#" + id).attr("value", likes);
                   $("#" + id).text(likes);
            });
       });


});
</script>
@stop
