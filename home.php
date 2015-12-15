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
			Select base image: <select name="baseImg">
				<option value="White_Background.png">Plain White Background</option>
				<option value="Eiffel_Tower.png">Eiffel Tower</option>
				<option value="Manhattan.png">Manhattan</option>
				<option value="Mona_Lisa.png">Mona Lisa</option>
			</select><br>
			<input type="submit">
		</form>

		<form action="decrypt.php" method="post" enctype="multipart/form-data">
			Message to Decrypt: <input type="file" id="fileToUpload" name="fileToUpload"><br>
			Select base image: <select name="baseImg">
				<option value="White_Background.png">Plain White Background</option>
				<option value="Eiffel_Tower.png">Eiffel Tower</option>
				<option value="Manhattan.png">Manhattan</option>
				<option value="Mona_Lisa.png">Mona Lisa</option>
			</select><br>
			<input type="submit" value="Upload Image" name="submit">
		</form>

	</body>
</html>