<?php
	session_start();
	if(isset($_POST['post_xoaID']))
	{
		$xoa_ID=$_POST['post_xoaID'];
		if(in_array($xoa_ID,$_SESSION['giohang_ID']))
		{
			$i = array_search($xoa_ID,$_SESSION['giohang_ID']);
			unset($_SESSION['giohang_ID'][$i]);
			array_filter($_SESSION['giohang_ID']);		
		}	
	}
	
	if(isset($_POST['post_do']))
	{
		unset($_SESSION['giohang_ID']);
		echo("giỏ hàng rỗng");
	}
?>