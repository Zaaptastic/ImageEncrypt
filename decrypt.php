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
					$temp[] .= $bin[$binIndex];
					$binIndex++;
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

</head>
<body>

Your message to decrypt is: <?php $msg = $_POST["msgDecrypt"]; echo $msg; ?><br>
Plaintext decrypted message is: <?php echo toStr($msg); ?><br>
Also, using image decryption:<br>
<?php 
	$baseImage = imagecreatefrompng("test.png");
	$encryptedImage = imagecreatefrompng("images/encryptedimage.png");
	$plaintext = imageDecrypt($baseImage,$encryptedImage);
?>
Decryption of image encrypted message: <?php echo "$plaintext"; ?> <br>
<a href="home.php">Return home</a>

</body>
</html>