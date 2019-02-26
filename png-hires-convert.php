<?php

//Get the output colors from color-palette.php and put them into the colorMap switch
//statement below. Unmatched colors will be converted to black. However, you can
//change this by setting the final return 0 to any color from 0 to 15.

//Specify the path to the image file in the imagecreatefrompng function. It will output
//a hires version of the top left 320x200 pixels of the image, with colors mapped accordingly.

//The C64 hires fileformat is Hi-Eddi. 
//http://codebase64.org/doku.php?id=base:c64_grafix_files_specs_list_v0.03

function colorMap($color) {
	switch($color) {
		case 0:
			return 0; //Black
		case 16777215:
			return 1; //White
		case 6829867:
			return 2; //Red
		case 7382194:
			return 3; //Cyan
		case 7290246:
			return 4; //Purple
		case 5803331:
			return 5; //Green
		case 3483769:
			return 6; //Blue
		case 12109679:
			return 7; //Yellow
  
		case 7294757:
			return 8; //Orange
		case 4405504:
			return 9; //Brown
		case 10119001:
			return 10;//Lt Red
		case 4473924:
			return 11;//Dk Grey
		case 7105644:
			return 12;//Md Grey
		case 10146436:
			return 13;//Lt Green
		case 7102133:
			return 14;//Lt Blue
		case 9803157:
			return 15;//Lt Grey
	}
	
	return 0;
}

$bitMask = array(128,64,32,16, 8,4,2,1);

$sourceImage = imagecreatefrompng("final-switch-left.png");

$bitmap = array();
$colmap = array();

//Arbitrarily prefer white to be the background color.
//This may only be a sensible move for the NES Tester image.

for($row=0;$row<25;$row++) {
	for($col=0;$col<40;$col++) {
		$fore = 1; //Initialize to white
		$back = 1; //Initialize to white

		//Source the foreground and background colors out of the cell.		
		for($byte=0;$byte<8;$byte++) {
			for($bit=0;$bit<8;$bit++) {
				$color = colorMap(imagecolorat($sourceImage,$col*8+$bit,$row*8+$byte));
				if($fore == $color || $back == $color)
					continue;
					
				if($fore == 1)
					$fore = $color;
				else
					$back = $color;
			}
		}
		
		//Set the bits high for all of the foreground colored pixels.
		for($byte=0;$byte<8;$byte++) {
			$imgByte = 0;
		
			for($bit=0;$bit<8;$bit++) {
				$color = colorMap(imagecolorat($sourceImage,$col*8+$bit,$row*8+$byte));
				
				if($color == $fore)
					$imgByte |= $bitMask[$bit];
			}
			
			$bitmap[] = $imgByte;
		}
		
		$colmap[] = ($fore << 4) + $back;
	}
}

$fh = fopen("output.hed","w");

fwrite($fh,chr(0).chr(32));

for($i=0;$i<8000;$i++)
	fwrite($fh,chr($bitmap[$i]));

for($i=0;$i<1000;$i++)
	fwrite($fh,chr($colmap[$i]));

fclose($fh);

