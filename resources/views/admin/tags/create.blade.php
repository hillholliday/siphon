
<form action="signup" method="POST">
	<label for="email">email</label>
	<input type="input" name="email" placeholder="email"><br>

	<label for="password">Password</label>
	<input type="password" name="password" placeholder="password"><br>

	<label for="confirm">Password</label>
	<input type="password" name="confirm" placeholder="password confirm"><br>

	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

	<input type="submit" value="Submit">
</form>
