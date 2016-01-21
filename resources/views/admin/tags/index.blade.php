@extends('admin.master')
@section('content')

<h2>Current Stream: {{$feed->title}} </h2>
<h3>Associated Tags</h3>
<ul>
@foreach($feed->tags as $tag)
	<li><a href="">{{$tag->title}}</a></li>
@endforeach
</ul>
<a href="{{URL::to('/')}}">add new tag</a>
@endsection
