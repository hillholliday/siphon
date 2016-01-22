@extends('admin.master')
@section('content')
	<h2>Register {{$network->title}} account for {{$team->name}} Team</h2>

	<form action="/team/{{$team->slug}}/feed/register/{{$network->id}}" method="POST">
		@if($network->title == 'twitter')
			<label for="api_key">API Key</label>
			<input type="input" name="api_key" placeholder="api key" value="{{{isset($keys->api_key) ? $keys->api_key : ''}}}"><br>

			<label for="api_secret">API Secret</label>
			<input type="input" name="api_secret" placeholder="api secret" value="{{{ isset($keys->api_secret) ? $keys->api_secret : '' }}}"><br>

			<label for="access_token">Access Token</label>
			<input type="input" name="access_token" placeholder="access token" value="{{{ isset($keys->access_token) ? $keys->access_token : '' }}}"><br>

			<label for="access_token_secret">Access Token Secret</label>
			<input type="input" name="access_token_secret" placeholder="access token secret" value="{{{ isset($keys->access_token_secret) ? $keys->access_token_secret : '' }}}"><br>
		@elseif($network->title == 'instagram')
			<label for="client_id">Client ID</label>
			<input type="input" name="client_id" placeholder="client_id" value="{{{ isset($keys->client_id) ? $keys->client_id : '' }}}"><br>

			<label for="client_secret">Client Secret</label>
			<input type="input" name="client_secret" placeholder="client_secret" value="{{{ isset($keys->client_secret) ? $keys->client_secret : '' }}}"><br>
		@else
			<h3>We can't find the network you're looking for</h3>
		@endif

		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="submit" value="register account" />
	</form>
@endsection
