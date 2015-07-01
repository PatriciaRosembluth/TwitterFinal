@extends('app')

@section('welcome')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Followers</h3></div>
				<table class="table table-striped">
   <tbody>
    @foreach ($follows as $follow)
    @foreach ($users as $user)
     @if ($follow->follower_id == $user->id)
    <tr>
        <td><img src="{{ ($user->image == null) ? '/uploads/default.png' : $user->image}}" style="width:100px;height:100px;" alt=""></td>
        <td><a href="/{{$user->user_name}}">{{$user->name}}</td>
    </tr>
    @endif
      @endforeach
      @endforeach
   </tbody>
</table>
			</div>
		</div>
	</div>
</div>
@endsection