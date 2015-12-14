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

	?>

</head>
<body>

Your message to encrypt is: <?php $msg = $_POST["msgEncrypt"]; echo $msg; ?><br>
Binary encrypted message is: <?php echo toBin($msg); ?><br>
<a href="home.php">Return home</a>

</body>
</html>