<?php
session_start();

$string = '';

for ($i = 0; $i < 5; $i++) {
	$string .= chr(rand(97, 122));
}

$_SESSION['random_number'] = $string;

$root_dir = str_replace("/", "\\", $_SERVER['DOCUMENT_ROOT']);
$dir = $root_dir.'/disos/func/fonts/';

//$image = imagecreatetruecolor(165, 50);
$image = imagecreatetruecolor(170, 50);

// random number 1 or 2
$num = 2;
if($num==1)
{
	$font = "Capture it 2.ttf"; // font style
}
else
{
	$font = "Molot.otf";// font style
}

// random number 1 or 2
$num2 = rand(1,2);
if($num2==1)
{
	$color = imagecolorallocate($image, 113, 193, 217);// color
}
else
{
	$color = imagecolorallocate($image, 163, 197, 82);// color
}

$white = imagecolorallocate($image, 255, 255, 255); // background color white
$gray = imagecolorallocate($image, 233, 233, 233); // background color white
imagefilledrectangle($image,0,0,399,99,$gray);

imagettftext($image, 30, 0, 25, 40, $color, $dir.$font, $string);

// header("Content-type: image/png");

//write the image to a variable
ob_start();
imagepng($image);
$imagePng = ob_get_contents();
ob_end_clean();
imagedestroy($image);

$imageData = base64_encode($imagePng);

$returnBody = array( 'base64' => $imageData, 'string' => $string );
echo json_encode( $returnBody );
?>