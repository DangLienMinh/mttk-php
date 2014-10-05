<html>
<head>
<title>Upload Form</title>
</head>
<body>

{$error}
{form_open_multipart('upload/do_upload')}
<textarea rows="4" cols="50" name="status"></textarea><br />
<input type="file" name="userfile" size="20" />
<br />

<input type="submit" value="upload" />

{form_close()}

</body>
</html>