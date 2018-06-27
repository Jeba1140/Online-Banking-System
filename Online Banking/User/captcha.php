<?Php
session_start();
header ("Content-type: image/png");
if(isset($_SESSION['my_captcha']))
{
unset($_SESSION['my_captcha']); 
}
$string1="abcdefghijklmnopqrstuvwxyz";
$string2="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$string3="1234567890";
$string=$string1.$string2.$string3;
$string= str_shuffle($string);
$random_text= substr($string,0,8); 
$_SESSION['my_captcha'] =$random_text; 
$im = @ImageCreate (80, 20)
or die ("Cannot Initialize new GD image stream");
$background_color = ImageColorAllocate ($im, 255, 252, 167); 
$text_color = ImageColorAllocate ($im, 51, 51, 255); 
$pixel_color = ImageColorAllocate ($im, 204, 204, 204); 
ImageString($im,5,5,2,$_SESSION['my_captcha'],$text_color);
for($i=0;$i<1000;$i++) {
    imagesetpixel($im,rand()%200,rand()%50,$pixel_color);
} 

ImagePng ($im); // image displayed
imagedestroy($im); 
?>

