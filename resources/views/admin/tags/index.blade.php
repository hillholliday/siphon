@extends('admin.master')
@section('content')

<h2>Current Stream: {{$feed->title}} </h2>
<h3>Associated Tags</h3>
<ul>
@foreach($feed->tags as $tag)
	<li>
		<a href="">{{$tag->title}}</a>
		<a href="/team/{{$team->slug}}/feed/{{$feed->id}}/delete/{{$tag->id}}">delete</a>
	</li>
@endforeach
</ul>
<a href="/team/{{$team->slug}}/feed/{{$feed->id}}/create">add new tag</a>
@endsection
