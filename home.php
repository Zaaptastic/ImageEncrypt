<!doctype html>

<html>
	<head>
		<title>Image Based Encryption</title>
		<link rel="stylesheet" type="text/css" href="website-stylesheet.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" ></script>
		<script src="website-scripts.js"></script>
		<?php



		?>
	</head>

	<body>

		<div id="header">
			<div id="banner">Image Encrypt</div>

			<div id="menu">
				<ul>
					<a href="home.php" id="current"><li>Home</li></a>
					<a href="about.html"><li>About</li></a>
					<a href="contact.html"><li>Contact</li></a>
				</ul>
			</div>
		</div>

		<div id="body">
			<div id="select">
				<div id="select-encrypt">Encrypt Image</div>
				<div id="select-decrypt">Decrypt Image</div>
			</div>

			<div id="options">
				<div class="body-options" id="body-encrypt" >
					<div class="body-description">
						<h2>Image Encryption</h2>
						Enter a message below and select an image you would like to use for the encryption. 
						We will hide the contents of your message within the image, which can later be decrypted using our Image Decrypt tool.
						Learn more about how Image Encryption works at our <a href="about.html">About Page</a>.<br><br>
						Please keep messages under 5000 characters. Smaller base images cannot support longer messages. 
						Encrypted Images will be provided for download as PNG files.
					</div><br>
					<div class="form">
						<form action="encrypt.php" method="post">
							Message to Encrypt: <br><textarea name="msgEncrypt" rows="4" cols="50"></textarea><br>
							Select base image: <select name="baseImg">
								<option value="White_Background.png">Plain White Background</option>
								<option value="Eiffel_Tower.png">Eiffel Tower</option>
								<option value="Manhattan.png">Manhattan</option>
								<option value="Mona_Lisa.png">Mona Lisa</option>
							</select><br>
							<input type="submit"value="Encrypt Image" name="submit">
						</form>
					</div>
					<div class="preview">
						<img src="" id="preview-image">
					</div>
				</div>
				<div class="body-options" id="body-decrypt">
					<div class="body-description">
						<h2>Image Decryption</h2>
						Upload an encrypted image below and select the image to be use as a key. 
						We will decrypt the message contained within the image.
						Learn more about how Image Decryption works at our <a href="about.html">About Page</a>.<br><br>
						Please ensure uploaded files are in PNG format. Also make sure to provide the correct base image.
					</div><br>
					<div class="form">
						<form action="decrypt.php" method="post" enctype="multipart/form-data">
							Image to Decrypt: <input type="file" id="fileToUpload" name="fileToUpload"><br>
							Select base image: <select name="baseImg">
								<option value="White_Background.png">Plain White Background</option>
								<option value="Eiffel_Tower.png">Eiffel Tower</option>
								<option value="Manhattan.png">Manhattan</option>
								<option value="Mona_Lisa.png">Mona Lisa</option>
							</select><br>
							<input type="submit" value="Decrypt Image" name="submit">
						</form>
					</div>
					<div class="preview">
						<img src="" id="preview-image">
					</div>

				</div>
			</div>

		</div>

		
	</body>
</html>