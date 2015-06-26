<?php
session_start();
if(isset($_SESSION['admin']))
{
	if($_SESSION['admin']=='admin')
	{
		header('location:page/loadpaging.php');
	}
}

?>
<?php
	if(isset($_POST['buttonLogin']))
	{
		$admin_username=  $_POST['admin_username'];
		$admin_password=  $_POST['admin_password'];
		require_once("../DataProvider.php");
		$sqlstr="select ID,username from admin where username='$admin_username' AND password='$admin_password'";
		$result=DataProvider::execQuery($sqlstr);
		$num=mysql_num_rows($result);
		if($num>0)
		{
			echo ("<script>alert('đăng nhập thành côgn');</script>");
			$_SESSION['admin']='admin';
			header("location:index.php");
			
			
		}else
		{
			echo ("<script>alert('tên tài khoản hoặc mật khẩu không chính xác');</script>");
		}
	}
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title>administrator - baby shop</title>
  <link rel="stylesheet" href="file/css/style.css" />
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  

</head>
<body>
     <div style="position:absolute; top: 10px; right:0px; color:  silver; text-align:right; margin-right:20px;">administrator | baby shop <a href="../index.php">Home page</a> </div>
  <form method="post" action="" class="login" autocomplete="off">
    <p>
      <label for="login">tài khoản</label>
      <input type="text" name="admin_username" id="login"/>
    </p>

    <p>
      <label for="password">mật khẩu:</label>
      <input type="password" name="admin_password" id="password"/>
    </p>

    <p class="login-submit">
      <button name="buttonLogin" type="submit" class="login-button">Login</button>
    </p>

  </form>
    
   
      <div style="position:absolute; bottom: 10px; right:0px; color:  gray;  text-align:right; margin-right:20px;"> product of easy web for life - 11ck4</div>
   
</body>
</html>
