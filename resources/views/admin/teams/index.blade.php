@extends('admin.master')
@section('content')
<h1>welcome {{$user->email}}</h1>
<h2>My Teams</h2>
<ul>
@foreach($user->teams as $team)
	<li>
		<a href="{{URL::to('/') . '/feeds/' . $team->slug}}">{{$team->name}}</a>
		<a href="{{URL::to('/') . '/teams/edit/' . $team->id}}">edit</a>
	</li>
@endforeach
</ul>
<a href="{{URL::to('/')}}/teams/create">add new team</a>
<a href="/logout">logout</a>
@endsection
