<?php
echo "My first PHP script! <br>";

$msg ="This is the message to be encoded 978";
$char = array();
$len = strlen($msg);

/*Convert message to binary
for($i = 0; $i < strlen($msg); $i++){
	$bin[$i] = decbin(ord($msg[$i]));
};
printString($bin,$len);
//Convert binary to plaintext
for($i = 0; $i < strlen($msg); $i++){
	$char[$i] = chr(bindec($bin[$i]));
};
printString($char,$len);*/
$imagecopy = imagecreatefromjpeg("logo-black.jpg");
imagejpeg($imagecopy,"images/newimage.jpg");
echo "$msg <br>";
$bin = toBin($msg);
printArray($bin);
toStr($bin);





function printString($str,$length){
	for($i = 0; $i < $length; $i++){
		echo "$str[$i]";
	};
	echo "<br>";
}

function printArray($arr){
	for($i = 0; $i<sizeof($arr); $i++){
		echo "$arr[$i]";
	}
	echo "<br>";
}


function fillColor($img){
	$to = imagecolorallocate($img, 0, 0, 255);
	for ($y = 0; $y < imagesy($img); $y++) {
        for ($x = 0; $x < imagesx($img); $x++) {
        	imagesetpixel($img,$x,$y,$to);
        }
    }
}

function turnRedder($img){
	for ($y = 0; $y < imagesy($img); $y++) {
        for ($x = 0; $x < imagesx($img); $x++) {
        	$rgb = imagecolorat($img, $x, $y);
        	$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;
			$r = $r + 100;
			if ($r >=255){
				$r=255;
			}
			$to=imagecolorallocate($img, $r, $g, $b);

        	imagesetpixel($img,$x,$y,$to);
        }
    }
}

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
	printArray($bin);
	echo "Converted bin len = ",sizeof($converted)," Message len = ",strlen($msg),"<br>";

	return $converted;

}

function toStr($bin){
	$simplifiedBin = array();
	$binIndex = 0;
	$msglen = sizeof($bin)/7;

	for ($i = 0; $i < $msglen; $i++){
		$temp = "";
		for ($j = 0; $j < 7; $j++){
			$temp[] .= $bin[$binIndex];
			$binIndex++;
		}
		$temp = implode("", $temp);
		$simplifiedBin[] = $temp;
	}

	printArray($simplifiedBin);

	$char = array();

	for($i = 0; $i < sizeof($simplifiedBin); $i++){
		$char[$i] = chr(bindec($simplifiedBin[$i]));
	};

	printArray($char);
}

function encrypt($img,$msg,$msglen){
	$currentMsgIndex = 0;
	for ($i = 0; $i < $msglen; $i++){
		var_dump($msg[$i]);
	}
}





?>