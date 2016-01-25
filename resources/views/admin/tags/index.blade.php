@extends('admin.master')
@section('content')

<h2>Current Stream: {{$feed->title}} </h2>
<h3>Tracking Tags</h3>
<ul>
@foreach($feed->tags as $tag)
	<li>
		{{$tag->title}}
		<input type="checkbox" name="status" value="{{$feed->status}}" {{{ $tag->status ? 'checked' : '' }}}>
		<a href="/team/{{$team->slug}}/feed/{{$feed->id}}/delete/{{$tag->id}}">delete</a>
	</li>
@endforeach
</ul>
<h3>Live Stream</h3>

<a href="/team/{{$team->slug}}/feed/{{$feed->id}}/create">add new tag</a>
@endsection
