<div class="panel-body-c">
             <div class="panel-heading-r">
                Reposted from {{DB::table('users')->find($post->user_id)->name}}<br>
                {{$post->created_at->format('d-m-Y / h:m:s')}}
             </div>
             <div class="panel-body-r">
                <textarea class="form-control" rows="5" cols="380" disabled>{{$post->content}}</textarea>
                <ul class="list breadcrumbs small" style="padding-left: 0px;">
                    Likes: <li id="{{$post->id}}" value="{{$post->likes}}">{{$post->likes}}</li>
                    Reposts: <li class="{{$post->id}}" value="{{$post->id}}"> {{$post->reposts}}</li>
                    <li><button class="btn-inv like-post2" value="{{$post->id}}"><span class="mif-thumbs-up fg-blue mif-2x"></span></button></li>
                     <li><button class="btn-inv deslike-post2" value="{{$post->id}}"><span class="mif-thumbs-down fg-black mif-2x"></span></button></li>
                     <li><button class="btn-inv repost2" value="{{$post->id}}"><span class="mif-share fg-green mif-2x"></span></a></button></li>
                    <li>{!! Form::open(array('route' => array('posts.destroy', $post->id), 'method' => 'DELETE')) !!}
                        <button type="submit" class="btn-inv"><span class="mif-fire fg-red mif-2x"></span></button>
                        {!! Form::close() !!}
                    </li>
                </ul> 
            </div>
             </div>
             <br>
<script>
             $(document).ready(function(){
       $('.repost2').click(function(){
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
       $('.like-post2').click(function(e){
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

$(document).ready(function(){
       $('.deslike-post2').click(function(e){
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