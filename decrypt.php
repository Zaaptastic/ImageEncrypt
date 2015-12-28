<html>

<head>
	<?php

		function toStr($bin){
			$simplifiedBin = array();
			$binIndex = 0;
			$msglen = strlen($bin)/7;

			for ($i = 0; $i < $msglen; $i++){
				$temp = "";
				for ($j = 0; $j < 7; $j++){
					if ($binIndex >= strlen($bin)){
						$temp[] .= "0";
					}else{
						$temp[] .= $bin[$binIndex];
						$binIndex++;
					}
				}
				$temp = implode("", $temp);
				$simplifiedBin[] = $temp;
			}



			$char = array();

			for($i = 0; $i < sizeof($simplifiedBin); $i++){
				$char[$i] = chr(bindec($simplifiedBin[$i]));
			};

			return implode("",$char);


		}

		function imageDecrypt($key,$img){
			$escape = 7;
			$extractedBin = "";
			for ($x = 0; $x < imagesx($key); $x++){
				//Compare color of both images at pixel coordinate
				$rgbKey=imagecolorat($key, $x, 0);
				$rgbImg=imagecolorat($img, $x, 0);
				//var_dump($rgbImg);
				if ($rgbKey == $rgbImg){
					$extractedBin .= "0";
					$escape--;
					if ($escape == 0){
						//var_dump($extractedBin);
						break;
					}
				}else{
					$extractedBin .= "1";
					$escape = 7;
				}


				if ($x >7 && substr($extractedBin,0,7) == "1111111"){
					return null;
				}
			}

			$msglen = toStr($extractedBin);
			$msglen = intval($msglen);
			$msg = "";

			for ($y = 1; $y < imagesy($img); $y++){
				for ($x =0; $x < imagesx($img); $x++){
					$rgbKey=imagecolorat($key, $x, $y);
					$rgbImg=imagecolorat($img, $x, $y);
					if ($rgbKey == $rgbImg){
						$msg .= "0";
					}else{
						$msg .= "1";
					}
					$msglen--;
					if ($msglen <= 0){
						break 2;
					}
				}
			}
			return toStr($msg);

		}

	?>
	<title>Image Based Encryption</title>
	<link rel="stylesheet" type="text/css" href="website-stylesheet.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" ></script>				<script src="/js/ajaxupload.js" type="text/javascript"></script>
	<script src="website-scripts.js"></script>
</head>
<body>

	<div id="header">
			<div id="banner">
				<img src="">
			</div>

			<div id="menu">
				<ul>
					<a href="home.php"><li>Home</li></a>
					<a href="about.html"><li>About</li></a>
					<a href="contact.html"><li>Contact</li></a>
				</ul>
			</div>
	</div>

	<div id="body">

		<?php 
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$plaintext = null;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        //echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}
			if($imageFileType != "png") {
		    	$uploadOk = 0;
			}
			if ($uploadOk == 0) {
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			        

					$img = $_POST["baseImg"];
					$baseImage = imagecreatefrompng("baseImages/$img");
					$encryptedImage = imagecreatefrompng($target_file);
					$plaintext = imageDecrypt($baseImage,$encryptedImage);
			    } else {
			    	$plaintext = null;
			    }
			}
		?>
		
		<div id="results">
			<?php if($plaintext != null){ ?>
			<h2>Decryption Successful!</h2>
			<div id="select">
				<a href="home.php"><div>Return Home</div></a>
			</div><br>
			Decryption of image encrypted message: <br><pre><?php echo "$plaintext"; ?> </pre><br>
			
			<?php 
				}else{
			?>
			<h2>Decryption Unsuccessful...</h2>
			Please ensure you are uploading a PNG image and have selected the correct base image.<br><br>

			<div id="select">
				<a href="home.php"><div>Try Again</div></a>
			</div>
			<br>

			<?php 
				}
				if ($uploadOk == 1){
					echo "Your uploaded image:<br>";
					echo "<img src=",$target_file,"> ";
				}

			?>

		</div>
	</div>

</body>
</html>