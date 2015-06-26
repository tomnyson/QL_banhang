<?php
session_start();
	if(isset($_POST['post_giohang_id']))
	{
		$them_id = $_POST['post_giohang_id'];
		if(!in_array($them_id,$_SESSION['giohang_ID']))
		{
			$_SESSION['giohang_ID'][]=$them_id;			
			echo "<a class='button2'><img src='skin/img/cart_add.png' />đã thêm</a>";	
		}
		else{
			
			echo "<script>alert('sản phẩm này đã có trong giỏ hàng')</script>";
		}
		echo "<a class='tra_ve_so_luong_gio_hang_".$them_id."'>".count($_SESSION['giohang_ID'])."</a>";
	}

?>