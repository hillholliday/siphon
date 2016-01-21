@extends('admin.master')
@section('content')
<h2>Edit Feed</h2>
<form action="/team/{{$team->slug}}/feed/update/{{$feed->id}}" method="POST">
	<label for="name">name</label>
	<input type="input" name="name" placeholder="name" value="{{$feed->title}}"><br>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<input type="submit" value="Submit">
</form>
@endsection
