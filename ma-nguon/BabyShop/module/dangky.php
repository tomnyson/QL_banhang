<style>
	.table_dangky{
		margin:15px 0px;
		border-radius:25px;
		border:1px #999 dotted;	
	}
	.div_dangky{
		
		margin:0px auto;
		width:700px;	
	}
</style>
<div class="div_dangky">
<?php
    $flag=false;
    $chon='';
    $thanhcong=false;
    if(isset($_POST['buttonDangKy']))
    {
        
        $textHoVaTen=$_POST['textHoVaTen'];
        $selectNgay=$_POST['selectNgay'];
        $selectThang=$_POST['selectThang'];
        
        $textMaKiemTra=$_POST['textMaKiemTra'];
        
		$textEmail=$_POST['textEmail'];
		
        $selectNam=$_POST['selectNam'];
        $selectNoiSong=$_POST['selectNoiSong'];
        $textTenDangNhap=$_POST['textTenDangNhap'];
		
		//mã hoá mật khẩu bằng chuỗi  md5 32 ký tự để tăng độ mạnh của mật khẩu
        $textMatKhau=md5($_POST['textMatKhau']); 
		
        
		
		
        $ngaysinh=$selectNam."-".$selectThang."-".$selectNgay;
        
         $sqlstr="select taikhoan from user where taikhoan='$textTenDangNhap'";
         $result= DataProvider::execQuery($sqlstr);
         $num=mysql_num_rows($result);
         if($num>0)
         {  
            $flag=true;            
            echo("<div class='thongbao'>tài khoản này đã bị trùng, vui chọn tên tài khoản khác</div>");
         }else{      
          $sqlstr="insert into user(taikhoan,matkhau,email,hoten,ngaysinh,noisong,ngaydangky)
                    values('$textTenDangNhap','$textMatKhau','$textEmail','$textHoVaTen','$ngaysinh',$selectNoiSong,NOW())";
          DataProvider::execQuery($sqlstr);
          $thanhcong=true;
        	//xuất thông tin đăng ký thành công
          ?>
            <div class="thongbao" style="font-weight:bold;font-size:14px; padding:10px;">
            <h2 style="color:#17888E;"><img src="skin/img/success.png"/><br />xin chúc mừng bạn đã đăng ký tài khoản thành công</h2>
                  <table width="360" border="0">
                      <tr>
                        <td width="154">&nbsp;</td>
                        <td width="196">&nbsp;</td>
                      </tr>
                      <tr>
                        <td><div align="right">họ và tên:</div></td>
                        <td><span class="button1"><?php echo $textHoVaTen; ?></span></td>
                      </tr>
                      <tr>
                        <td><div align="right">tên tài khoản:</div></td>
                        <td><span class="button1"><?php echo $textTenDangNhap; ?></span></td>
                      </tr>
                      <tr>
                        <td><div align="right">địa chỉ email:</div></td>
                        <td><span class="button1"><?php echo $textEmail; ?></span></td>
                      </tr>
                      <tr>
                        <td><div align="right">ngày tháng năm sinh:</div></td>
                        <td><span class="button1"><?php echo $ngaysinh; ?></span></td>
                      </tr>
                      <tr>
                        <td><div align="right">ngày đăng ký:</div></td>
                        <td><span class="button1"><?php echo date('d - m - Y h:m:s'); ?></span></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                  </table>
                
            </div>
          <?php
         }   
    }
//huỷ post
unset($_POST);
?>
<?php
    if($thanhcong==false)    
    {
?>
<script type="text/javascript" src="js/form/form_dangkyuser.js">
</script>
<form method="post" action="" name="fom_dangkyuser" onsubmit="return check_dangkyuser(this);" autocomplete="off">
  <div align="center">
  <style type="text/css">
strong {
	color: #FFF;
}
</style>
  <table class="table_dangky" width="646" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <td height="47" colspan="2" bgcolor="#999999"><div align="center"><strong>đăng ký tài khoản</strong></div></td>
      </tr>
    <tr bgcolor="#666666">
      <td height="38" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong style="color:#666666;">thông tin cá nhân</strong></div></td>
      </tr>
    <tr>
      <td width="168" height="45"><div align="right">họ tên của bạn</div></td>
      <td><input type="text" name="textHoVaTen" id="textHoVaTen" value="<?php echo ($flag)?$textHoVaTen:"";?>"/></td>
      </tr>
    
    <tr>
      <td height="46"><div align="right">ngày sinh </div></td>
      <td>
        <select name="selectNgay" id="selectNgay" style="width:85px;" />
        <option value='-1'>-- ngày --</option>
        <?php 
		for($i=1; $i<=31; $i++)
			  if($flag && $i==$selectNgay)
                {
                    echo "<option value='$i' selected>ngày $i</option>"; 
                }
                else
                {
                    echo "<option value='$i' >ngày $i</option>"; 
                }
	?>
        </select>
        
        	<select name="selectThang" id="selectThang" style="width:85px;"/>
        <option value='-1'>-- tháng --</option>
        <?php 
		for($i=1; $i<=12; $i++)
			  if($flag && $i==$selectThang)
                {
                    echo "<option value='$i' selected>tháng $i</option>"; 
                }
                else
                {
                    echo "<option value='$i' >tháng $i</option>"; 
                }
		?>
        </select>
        
        <select name="selectNam" id="selectNam" style="width:85px;"/>
        <option value='-1'>-- năm --</option>
        <?php 
			for($i=date('Y'); $i>=1920; $i--)
                   
                if($flag && $i==$selectNam)
                {
                    echo "<option value='$i' selected>năm $i</option>"; 
                }
                else
                {
                    echo "<option value='$i' >năm $i</option>"; 
                }
            	
                   
			?>
        </select>
      
      </td>
      </tr>
    <tr>
      <td height="47"><div align="right">bạn sống tại </div></td>
      <td><select name="selectNoiSong" id="selectNoiSong">
        <option value='-1'>-- nơi sống --</option>
        <?php
			$strql="select * from thanhpho";
			$result=DataProvider::execQuery($strql);
			while($row = mysql_fetch_array($result))
			{?>
        <option value="<?php echo $row[0]; ?>" <?php echo ($flag && $selectNoiSong==$row[0])?'selected':''; ?>><?php echo $row[1]; ?></option>
        
        <?php	
			}
			?>	
        
        
        </select></td>
    </tr>
    
    <tr bgcolor="#666666">
      <td height="46" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong style="color:#666666;">thông tin tài khoản</strong></div></td>
      </tr>
    <tr>
      <td height="46"><div align="right">địa chỉ email *</div></td>
      <td><input type="text" name="textEmail" id="textEmail" <?php echo ($flag)?"value=".$textEmail:''; ?> /></td>
      </tr>
    <tr>
      <td height="46"><div align="right">tên đăng nhập *</div></td>
      <td><input type="text" name="textTenDangNhap" id="textTenDangNhap" value="<?php echo ($flag)?$textTenDangNhap:"";?>"/></td>
      </tr>
    <tr>
      <td height="53"><div align="right">mật khẩu *</div></td>
      <td><input type="password" name="textMatKhau" id="textMatKhau" /></td>
      </tr>
    <tr>
      <td height="49"><div align="right">xác nhận mật khẩu *</div></td>
      <td><input type="password" name="textTenXacNhanMatKhau" id="textTenXacNhanMatKhau" /></td>
      </tr>
    <tr bgcolor="#666666">
      <td height="51" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong style="color:#666666;">xác nhận</strong></div></td>
      </tr>
    <tr>
      <td height="54"><div align="right">nhập mã kiểm tra *</div></td>
      <td><div style="margin-left:30px;">
        <!------------HÀM LOAD CAPCHA----------->        
        <script type="text/javascript">
            function reload(thiss)
            {
                thiss.src="ajax/capcha/cap.php";
            }
        </script> 
        
        <?php 
         //TẠO 1 CHUỖI CAP CHA 5 CHỮ SỐ NGẦU NHIÊN LƯU VÀO SESSION capcha_session
         $_SESSION['capcha_session']=substr(md5(rand(1,20)),rand(1,20),5);     
         ?> 
        <!------------CHÈN ẢNH CAPCHA LÀ 5 KÝ TỰ NGẪU NHIÊN TỪ SESSION----------->                 
        <img src="ajax/capcha/cap.php" id="capcha" />
        <input  style="margin-left:10px; width:60px;" type="text" name="textMaKiemTra" id="textMaKiemTra"/>
        <input type="hidden" name="hiddenMaKiemTra" id="hiddenField" value="<?php echo $_SESSION['capcha_session']; ?>"/>
         </div>
        </td>
      </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input class="button3" type="submit" name="buttonDangKy" id="buttonDangKy" value="đăng ký thành viên" />
        </div></td>
    </tr>
  </table>
  </div>
</form>



</div>

<?php } /* ĐĂNG KÝ CHƯA THÀNH CÔNG*/?>