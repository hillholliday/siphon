@extends('admin.master')
@section('content')

<h2>Current Team: {{$team->name}} </h2>
<h3>Associated Feeds</h3>
<ul>
@foreach($team->feeds as $feed)
	<li><a href="/feeds/{{$team->link}}/tags/{{$feed->id}}">{{$feed->title}}</a></li>
@endforeach
</ul>
<a href="{{URL::to('/')}}">add new feed</a>
@endsection
