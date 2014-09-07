<html>
<head>
<title>My Form</title>
<link rel="stylesheet" type="text/css" href="{asset_url()}css/main.css">
</head>
<body>
{validation_errors()}
{form_open('form')}


<h5 class="test">Username</h5>
<input type="text" name="username" size="50" />

<h5>Password</h5>
<input type="text" name="password"  size="50" />

<div><input type="submit" value="Submit" /></div>

{form_close()}

</body>
</html>
