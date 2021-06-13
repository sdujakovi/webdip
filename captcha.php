<?php
session_start();
$random_alpha = md5(rand());
$captcha_code = substr($random_alpha, 0, 6);
$_SESSION['captcha'] = $captcha_code;
header('Content-Type: image/jpeg');
//$image = imagecreatetruecolor(200, 38);
$background_color = imagecolorallocate($image,245,255,250);
$text_color = imagecolorallocate($image, 46, 149, 184);
imagefilledrectangle($image, 0, 0, 200, 38, $background_color);
$font = dirname(__FILE__) . '/Lemon.otf';
imagettftext($image, 20, 0, 60, 28, $text_color, $font, $captcha_code);
imagepng($image);
imagedestroy($image);
?>