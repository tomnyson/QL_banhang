<?php
    $tg=time();
    $tgout=900;
    $tgnew=$tg - $tgout;
    $ip=$_SERVER['REMOTE_ADDR'];
    $path=$_SERVER['PHP_SELF'];
    
    DataProvider::Ghi_Nhan_Online($tg,$ip,$path);
?>