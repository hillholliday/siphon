@extends('admin.master')
@section('content')
<form action="/teams/update/{{$team->id}}" method="POST">
	<label for="name">name</label>
	<input type="input" name="name" placeholder="name" value="{{$team->name}}"><br>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<input type="submit" value="Submit">
</form>
@endsection
