@extends('admin.master')
@section('content')
<form action="/teams/update" method="POST">
	<label for="name">name</label>
	<input type="input" name="name" placeholder="name"><br>
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<input type="submit" value="Submit">
</form>
@endsection
