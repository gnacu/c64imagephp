<?php

//Adjust the colors at the top left of the color-palette.png file to match
//the colors that are output by the program you are using. 

//The ones in the file in this repository are being output by HiRes, 
//https://dschwen.github.io/hires/

//Copy the printed out colors into the colormap switch statement in 
//png-hires-convert.php.

$colorPalette = imagecreatefrompng("color-palette.png");

$colors = array();

$colors[] = imagecolorat($colorPalette,8*0,8*0);
$colors[] = imagecolorat($colorPalette,8*1,8*0);
$colors[] = imagecolorat($colorPalette,8*2,8*0);
$colors[] = imagecolorat($colorPalette,8*3,8*0);
$colors[] = imagecolorat($colorPalette,8*4,8*0);
$colors[] = imagecolorat($colorPalette,8*5,8*0);
$colors[] = imagecolorat($colorPalette,8*6,8*0);
$colors[] = imagecolorat($colorPalette,8*7,8*0);

$colors[] = imagecolorat($colorPalette,8*0,8*1);
$colors[] = imagecolorat($colorPalette,8*1,8*1);
$colors[] = imagecolorat($colorPalette,8*2,8*1);
$colors[] = imagecolorat($colorPalette,8*3,8*1);
$colors[] = imagecolorat($colorPalette,8*4,8*1);
$colors[] = imagecolorat($colorPalette,8*5,8*1);
$colors[] = imagecolorat($colorPalette,8*6,8*1);
$colors[] = imagecolorat($colorPalette,8*7,8*1);

print_r($colors);