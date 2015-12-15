<!doctype html>

<html>
	<head>
		<title>Image-Based Encryption</title>

		<?php
			function alert(){
				return "Test of php functionality";
			}



		?>
	</head>

	<body>

		<form action="encrypt.php" method="post">
			Message to Encrypt: <input type="text" name="msgEncrypt"><br>
			<input type="submit">
		</form>

		<form action="decrypt.php" method="post" enctype="multipart/form-data">
			Message to Decrypt: <input type="file" id="fileToUpload" name="fileToUpload"><br>
			<input type="submit" value="Upload Image" name="submit">
		</form>

	</body>
</html>