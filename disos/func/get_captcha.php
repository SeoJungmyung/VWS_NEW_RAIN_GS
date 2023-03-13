<?php
session_start();

header("Content-type: image/png");

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
$num = rand(1,2);
if($num==1)
{
	$font = "NanumBrush.ttf"; // font style
}
else
{
	$font = "NanumPen.ttf";// font style
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
$black = imagecolorallocate($image, 0, 0, 0); // background color white
$gray = imagecolorallocate($image, 233, 233, 233); // background color white
imagefilledrectangle($image,0,0,399,99,$gray);

$num3 = rand(-6,6);
$num4 = 40 + ($num3+intval($num3/2));
imagettftext($image, 38, $num3, 25, $num4, $color, $dir.$font, $string);

$dat1 = rand(1,10);
$dat2 = rand(70,90);
$dat3 = rand(190,210);
$dat4 = rand(0,10);
$dat5 = rand(80,100);
$points = array(0,$dat1,100,$dat2,$dat3,$dat4,399,$dat5);
// $points = array(0,10,100,90,200,8,399,89);
$po = count($points) / 2;
imagepolygon($image, $points, $po, $black);
// imageopenpolygon($image,$points, 3,$black);
// imageline($image,0,30,399,40,$black);

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