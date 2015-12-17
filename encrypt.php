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
	<title>Image Based Encryption</title>
	<link rel="stylesheet" type="text/css" href="website-stylesheet.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" ></script>				<script src="/js/ajaxupload.js" type="text/javascript"></script>
	<script src="website-scripts.js"></script>

</head>
<body>

	<div id="header">
			<div id="banner">Image Encrypt</div>

			<div id="menu">
				<ul>
					<a href="home.php"><li>Home</li></a>
					<a href="about.html"><li>About</li></a>
					<a href="contact.html"><li>Contact</li></a>
				</ul>
			</div>
	</div>

	<div id="body">
		<div id="results">
			<h2>Encryption Successful!</h2>

			<div id="select">
				<a href="images/encryptedimage.png" download="encryptedimage"><div>Download Encrypted Image</div></a>
				
			</div>
			<br>
			Your message:<br> <pre><?php $msg = $_POST["msgEncrypt"]; echo $msg; ?></pre><br>
			<?php 
				$img = $_POST["baseImg"];
				$baseImage = imagecreatefrompng("baseImages/$img");
				$newImage = imageEncrypt($baseImage,$msg);
				imagepng($newImage,"images/encryptedimage.png");
			?>

		</div>

	</div>

</body>
</html>