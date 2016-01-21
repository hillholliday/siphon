@extends('admin.master')
@section('content')

<h2>Current Team: {{$team->name}} </h2>
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
<a href="/team/{{$team->slug}}/feed/create">add new feed</a>
@endsection
