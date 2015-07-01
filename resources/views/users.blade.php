@extends('app')

@section('welcome')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Users</h3></div>
				<table class="table table-condensed">
    <thead>
     <tr>
      <th></th>
       <th>Username</th>
     	 <th>Full Name</th>
    </tr>
   </thead>
   <tbody>
   	@foreach ($users as $user)
    <tr>
        <td><img src="{{ ($user->image == null) ? '/uploads/default.png' : $user->image}}" style="width:35px;height:35px;" alt=""></td>
        <td><a href="/{{$user->user_name}}">{{$user->user_name}}</td>
        <td>{{$user->name}}</td>
    </tr>
      @endforeach
   </tbody>
</table>
			</div>
		</div>
	</div>
</div>
@endsection