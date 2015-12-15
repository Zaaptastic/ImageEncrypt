<html>

<head>
	<?php
		function toBin($msg){
			//Convert message to binary
			$bin = array();
			for($i = 0; $i < strlen($msg); $i++){
				$bin[$i] = decbin(ord($msg[$i]));
			};
			//Convert into one long string
			$converted = array();
			for($i = 0; $i < sizeof($bin); $i++){
				if (strlen($bin[$i])<7){
					for ($diff = 7 - strlen($bin[$i]); $diff>0;$diff--){
						$converted[] = 0;
					}
				}
				for($j = 0; $j < strlen($bin[$i]); $j++){
					$converted[] = $bin[$i][$j];
				}
			};

			return implode("",$converted);

		}

		function imageEncrypt($img,$msg){
			//set metadata (first line of image)
			//encode length of message
			$msglen = strlen($msg)*7; //number of bits in message
			$msglenBin = toBin("$msglen"); //number of bits represented in binary
			for ($x = 0; $x < strlen($msglenBin); $x++){
				colorAdjust($img,$x,0,$msglenBin[$x]);
				//var_dump(imagecolorat($img, $x, 0));
			}
			$msgBin = toBin($msg); //message to be sent represented in binary
			$msgIndex = 0;
			for ($y = 1; $y < imagesy($img); $y++){
				for ($x =0; $x < imagesx($img); $x++){
					colorAdjust($img,$x,$y,$msgBin[$msgIndex]);
					$msgIndex++;
					if ($msgIndex >= $msglen){
						break 2;
					}
				}
			}

			return $img;
		}

		function colorAdjust($img,$x,$y,$value){
			if ($value == '1'){
				$rgb = imagecolorat($img, $x, $y);
	        	$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				$r = $r - 1;
				if ($r >=255){
					$r=245;
				}
				$to=imagecolorallocate($img, $r, $g, $b);
        		imagesetpixel($img,$x,$y,$to);
			}else{
			}
		}



	?>

</head>
<body>

Your message to encrypt is: <?php $msg = $_POST["msgEncrypt"]; echo $msg; ?><br>
<?php 
	$baseImage = imagecreatefrompng("test.png");
	$newImage = imageEncrypt($baseImage,$msg);
	imagepng($newImage,"images/encryptedimage.png");
?>
Binary encrypted message is: <?php echo toBin($msg); ?><br>
<a href="home.php">Return home</a>

</body>
</html>