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

	?>

</head>
<body>

Your message to decrypt is: <?php $msg = $_POST["msgDecrypt"]; echo $msg; ?><br>
Plaintext decrypted message is: <?php echo toStr($msg); ?><br>
<a href="home.php">Return home</a>

</body>
</html>