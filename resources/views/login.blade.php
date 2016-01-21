
<form action="login" method="POST">
	<label for="email">Username</label>
	<input type="input" name="email" placeholder="email"><br>

	<label for="password">Password</label>
	<input type="password" name="password" placeholder="password"><br>

	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

	<input type="submit" value="Submit">
</form>
