<html>
<head>
<title>My Form</title>
<link rel="stylesheet" type="text/css" href="{asset_url()}css/main.css">
</head>
<body>
{validation_errors()}
{form_open('form/register')}

<h1>Register account</h1>
<h5 class="test">Email</h5>
<input type="text" name="email"/>

<h5>Password</h5>
<input type="text" name="password"/>

<h5>First name</h5>
<input type="text" name="first_name"/>

<h5>Last name</h5>
<input type="text" name="last_name"/>

<h5>Birthday</h5>
<input type="text" name="birthday"/>


<div><input type="submit" value="Submit" /></div>

{form_close()}

{form_open('form/login1')}
<h5>email name</h5>
<input type="text" name="email_login"/>

<h5>ps</h5>
<input type="text" name="pass_login"/>
<div><input type="submit" value="Login" /></div>
{form_close()}
</body>
</html>
