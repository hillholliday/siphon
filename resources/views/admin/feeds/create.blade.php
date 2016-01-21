@extends('admin.master')
@section('content')
<h2>Create New Feed</h2>
<form action="/team/{{$team->slug}}/feed/store" method="POST">
	<label for="name">name</label>
	<input type="input" name="name" placeholder="name"><br>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<input type="submit" value="Submit">
</form>
@endsection
