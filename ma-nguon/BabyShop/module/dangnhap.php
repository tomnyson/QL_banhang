<?php
    if(isset($_POST['buttonDoiLogin']))
    {	
		 $textUsername=$_POST['textUsername'];
		//biến sang md5 để so với mật khẩu trong csđl. do csdl dùng md5 đễ mã hoá mật khẩu
        $textPassword=md5($_POST['textPassword']); 
         
         $sqlstr = "select ID,taikhoan from user where taikhoan='$textUsername' and matkhau='$textPassword'";
         $result=DataProvider::execQuery($sqlstr);
         
         if(mysql_num_rows($result)>0)
         {
	      
            // echo "<script>alert(".$row['ID'].");</script>";
            //echo("đăng nhập thành công");
            //set sesion
            $row=mysql_fetch_array($result);
            if(TrangThai::is_locked($row['ID'])==false) //nếu chưa khoá
            {
            $_SESSION['user']['id']=$row['ID'];
            $_SESSION['user']['username']=$row['taikhoan'];
            header("location:loadpaging.php");
            }
            else{ //nếu bị khoá
                echo("<div class='thongbao'><img src='skin/img/locked2.png' /> <br>rất tiếc! tài khoản của bạn đã bị khoá bới quản trị viên!</div>");
            }
            
         }else
         {
            echo("<div class='thongbao'><img src='skin/img/keys2.png' /> <br>tài khoản hoặc mật khẩu không chính xác!</div>");
         }
      	//huỷ post
        unset($_POST);  
    }
    
    //ẨN HÊT PHẦN FORM DƯỚI
    if(trangthai::is_login()==false)
    {
?>
<script type="text/javascript" src="js/form/form_dangnhap.js"></script>
        <form method="post" action="" autocomplete="off" onsubmit="return kiem_tra_dangnhap(this);">
          <div align="center">
            <style type="text/css">
        strong {
        	color: #FFF;
        }
        </style>
            <table width="583" height="159" class="thongbao">
              <tr>
                <td height="25" colspan="2"><div align="center" style="color:#800040;">ĐĂNG NHẬP</div></td>
              </tr>
              <tr>
                <td width="114" height="47"><div align="right">tên tài khoản</div></td>
                <td width="457"><input type="text" name="textUsername" id="textUsername" /></td>
              </tr>
              
              <tr>
                <td height="45"><div align="right">mật khẩu</div></td>
                <td><input type="password" name="textPassword" id="textPassword" /></td>
              </tr>
              <tr>
                <td height="30" colspan="2"><div align="center">
                  <input class="button3" type="submit" name="buttonDoiLogin" id="buttonDoiLogin" value="đăng nhập" />
                </div></td>
              </tr>
            </table>
          </div>
        </form>
<?php }?>

