@extends('admin.master')
@section('content')

<h2>Current Team: {{$team->name}} </h2>

@foreach($networks as $network)
	<a href="/team/{{$team->slug}}/feed/register/{{$network->id}}">register {{$network->title}} account</a><br/>
@endforeach

<h3>Associated Feeds</h3>
<ul>
@foreach($team->feeds as $feed)
	<li>
		<a href="/team/{{$team->slug}}/feed/{{$feed->id}}">{{$feed->title}}</a>
		<a href="/team/{{$team->slug}}/feed/edit/{{$feed->id}}">edit</a>
		<a href="/team/{{$team->slug}}/feed/delete/{{$feed->id}}">delete</a>
	</li>
@endforeach
</ul>
<br/>
<a href="/team/{{$team->slug}}/feed/create">add new feed</a>
@endsection
