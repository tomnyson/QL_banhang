<?php session_start(); 
    //-------------------CAPCHA SESSION----------------------------------------------------------------------
    //t?o 1 chu?i capcha 5 k? t? 

    	
    $capcha_session= $_SESSION['capcha_session'];
    //-------------------CAPCHA SESSION----------------------------------------------------------------------

header("Content-Type: image/png"); //khai báo nội dung đây là một file ảnh

$im = @imagecreate(60, 20) //tạo palet ảnh
    or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($im, 0, 0, 0); //màu nền
$text_color = imagecolorallocate($im, 233, 14, 91);		//màu chữ
imagestring($im, 11, 0, 0,  "$capcha_session", $text_color); //tạo chuỗi
imagepng($im);	//tạo ảnh png từ palet
imagedestroy($im);	//giái phóng vùng nhớ ảnh
?>

