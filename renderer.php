<?php

//This is designed to be put on a server configured to serve PHP.

//Change the path and filename in the file_get_contents() function to 
//point to a 4K character set. It converts the bitmap data to a PNG
//image, 256x128 px. This is just to visualize the data.


if($_GET["render"]) {
	//chargen rom file, taken from x64 VICE for macOS.
	$contents = file_get_contents("chargen.bin");

	//32 * 16 characters
	//image resolution 256x128

	$img = imagecreate(256,128);

	$background_color = imagecolorallocate($img, 0, 0, 0);

	$whitePX = imagecolorallocate($img,255,255,255);


	$byteIndex = 0;

	for($row = 0;$row<16;$row++) {
		for($col = 0;$col<32;$col++) {
			for($raster=0;$raster<8;$raster++) {
				$byte = ord($contents[$byteIndex++]);
				
				for($bit=0;$bit<8;$bit++) {
					if($byte & (1 << (7-$bit))) {
						$x = ($col * 8) + $bit;
						$y = ($row * 8) + $raster;
						
						imagesetpixel($img,$x,$y,$whitePX);
					}
				}
			
			}
		}
	}

	imagepng($img);
	imagedestroy($img);

	die();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Bitmap Renderer</title>
		<style type="text/css">
			body {
				background-color:grey;
			}
		</style>
	</head>
	<body>
		<img src="renderer.php?render=1">
	</body>
</html>
