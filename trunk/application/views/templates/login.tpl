<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>MMusic Login</title>
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/login.css">
</head>
<body>
	<div class="error">{validation_errors()}</div>

  	<div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>My<span>Music</span></div>
		</div>
		<br>
		{form_open('userController/login1')}
		<div class="login">
				<input type="text" placeholder="Email..." name="email_login"><br>
				<input type="password" placeholder="Password..." name="pass_login"><br>
				<input type="submit" value="Login" /><br><br>
				<a href="#">Forgot your password?</a>
		</div>
		{form_close()}
		{form_open('userController/register')}
		<div class="register">
				<input type="text" placeholder="Your email..." name="email"><br>
				<input type="password" placeholder="Password" name="password"><br>
				<input type="password" placeholder="Re-type password" name="re_password"><br><br>
				<input type="text" placeholder="First name" name="first_name" class="nameInput">
				<input type="text" placeholder="Last name" name="last_name" class="nameInput"><br><br>
				<input type="text" placeholder="Date of birth" name="birthday"/>
				<input type="submit" value="Register" />
		</div>
		{form_close()}
</body>
</html>