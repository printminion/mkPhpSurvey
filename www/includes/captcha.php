<?php
/**
 * Show captcha image
 * @version $Id: captcha.php 106 2007-10-18 00:48:15Z mimait04 $
 */

chdir('..');
include_once('configuration.php');

if ($_GET['ctoken'] == ''){
   flushImageError();
}

$imagePath = TEMP_PATH.CAPTCHA_PREFIX.$_GET['ctoken'].'.jpg';


if (file_exists($imagePath)){
   flushImage($imagePath);
}else{
   flushImageError();
}

function flushImageError(){
   header("Content-type: image/jpeg");
   $im = @imagecreate(198, 72)
   or die("Cannot Initialize new GD image stream");
   $background_color = imagecolorallocate($im, 255, 255, 255);
   $text_color = imagecolorallocate($im, 233, 0, 0);
   imagestring($im, 12, 5, 5,  "Sorry we cannot", $text_color);
   imagestring($im, 12, 5, 25,  "proceed your request", $text_color);
   imagejpeg($im);
   imagedestroy($im);
   die();
}

function flushImage($imagePath){
   header("Content-type: image/jpeg");
   $im = @imagecreatefromjpeg($imagePath);
   imagejpeg($im);
   imagedestroy($im);
   die();
}
?>