
<style type="text/css">
strong {
	color: #0FF;
}
strong {
	color: #DCF5D3;
}
</style>
     
<form method="post" action="" onsubmit="return check_doimatkhau(this);">
<style type="text/css">
strong {
	color: #FFF;
}
</style>

<?php
//ĐỔI MẬT KHẨU

    if(isset($_POST['buttonDoiMatKhau']))
    {
        $matkhaumoi=$_POST['textMatKhauMoi'];
        $sqlstr="UPDATE admin SET `password`='$matkhaumoi' WHERE username='".$_SESSION['admin']."'";        
        DataProvider::execQuery($sqlstr);
   
	   ?>
       		<div class="thongbao"><img src='../skin/img/success.png' /><Br /><h2 style="color:#5576E6; padding:20px;">mật khẩu admin đã được thay đổi</h2></div>
       <?php
	   	
	   
    }
?>
<link rel="stylesheet" type="text/css" href="../skin/css/button.css" />
<div class="thongbao"><script type="text/javascript" src="file/js/form/check_doimatkhau.js"></script>   
  <table width="483" height="174" align="center">
    <tr>
      <td height="29" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>ĐỔI MẬT KHẨU ADMIN</strong></div></td>
      </tr>
    <tr>
      <td width="203" height="46"><div align="right">mật khẩu mới</div></td>
      <td width="268"><input type="password" name="textMatKhauMoi" id="textMatKhauMoi" /></td>
      </tr>
    
    <tr>
      <td height="52"><div align="right">lặp lại mật khẩu mới</div></td>
      <td><input type="password" name="textXacNhanMatKhauMoi" id="textXacNhanMatKhauMoi" /></td>
      </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input class="button3" type="submit" name="buttonDoiMatKhau" id="buttonDoiMatKhau" value="đổi mật khẩu" />
        </div></td>
      </tr>
  </table>
</div>
</form>