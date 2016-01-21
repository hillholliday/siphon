@extends('admin.master')
@section('content')
<h1>welcome {{$user->email}}</h1>
<h2>My Teams</h2>
<ul>
@foreach($user->teams as $team)
	<li>
		<a href="/team/{{$team->slug}}/feed">{{$team->name}}</a>
		<a href="/team/{{$team->slug}}/edit">edit</a>
		<a href="/team/{{$team->slug}}/delete">delete</a>
	</li>
@endforeach
</ul>
<a href="/team/create">add new team</a>
<a href="/logout">logout</a>
@endsection
