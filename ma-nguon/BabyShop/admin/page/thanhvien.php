<div style="position:relative;">
  <?php 
  $tong_thanh_vien=DataProvider::So_Luong_Thanh_Vien_Trong_CSDL(); 
  $thanhvien_bikhoa=DataProvider::So_Luong_Thanh_Vien_Bi_Khoa();
  echo '<div>tất cả: ('.$tong_thanh_vien.') thành viên và ('.$thanhvien_bikhoa.') bị khoá</div>';        
   
   ?>
   <hr />
 <div style="wposition: relative; width:150px; padding:15px;  margin:0px auto;">
    	 <a href="administrator.php?page=thanhvien&do=them"> <input class="chucnang" type="submit" name="buttonThemAnHien" id="buttonThemAnHien" value="thêm thành viên mới"/></a>
   	 
    </div>
<?php
	//thêm----------------------------------------------------------------------

	if(isset($_POST['buttonThem']))
	{	
		//$s_ID=$_POST['hiddenID'];
		$textTaiKhoan=$_POST['textTaiKhoan'];
		$textMatKhau=md5($_POST['textMatKhau']); //mã hoá về md5 trước khi nhập xuống csdl	
		$textEmail=$_POST['textEmail'];
		$textTrangThai=$_POST['selectTrangThai'];  
        $textNgaySinh = date('Y-m-d',strtotime($_POST['selectNgay']."/".$_POST['selectThang']."/".$_POST['selectNam']));
        $textNoiSong=$_POST['selectNoiSong'];
        $textHoTen=$_POST['textHoTen'];
    
		
		$sqlstr="INSERT INTO user(TaiKhoan,MatKhau,HoTen,Email,TrangThai,NgaySinh,NoiSong,NgayDangKy)
        values('$textTaiKhoan','$textMatKhau','$textHoTen','$textEmail',$textTrangThai,'$textNgaySinh',$textNoiSong,NOW())";				
        DataProvider::execQuery($sqlstr);
        header("location:administrator.php?page=thanhvien");
	}
	//xoá
	if(isset($_GET['do']) && isset($_GET['id']))
	{
		if($_GET['do']=='xoa' && (is_numeric($_GET['id'])==true))
		{
		   $sqlstr="DELETE FROM user WHERE ID=".$_GET['id'];  	
	       DataProvider::execQuery($sqlstr);
           header("location:administrator.php?page=thanhvien");
		}
	}	
    
    	$flag=false; //cho biết có móc được dữ liệu từ sản phẩm đang chọn hay không
	//lấy biến sửa
	if(isset($_GET['do']) && isset($_GET['id']))
	{
		if($_GET['do']=='sua' && (is_numeric($_GET['id'])==true))
		{
				$ID=$_GET['id'];
				$s_ID=0;
				$s_TaiKhoan="";
				$s_MatKhau="";
				$s_TrangThai=0;	
				$s_Email="";
					/*LẤY RA THÔNG TIN CỦA ĐỒ CHƠI ĐANG CẦN SỬA*/
					$sqlstr="select * from user where id = $ID";
					
					$result=DataProvider::execQuery($sqlstr);
					$row=mysql_fetch_array($result);
					if(count(mysql_num_rows($result))>0)
					{
							$s_ID=$row['ID'];
							$s_TaiKhoan=$row['TaiKhoan'];		
							$s_MatKhau='';					
						    $s_TrangThai=$row['TrangThai']; 							
							$s_Email=$row['Email']; 		
							$flag=true; //đã móc được
					}
		}
	}
	//sửa //nếu người dùng bấm vào nút button sửa
	if(isset($_POST['buttonSua']))
	{	
	  
		$s_ID=$_POST['hiddenID'];
		$s_TaiKhoan=$_POST['textTaiKhoan'];
		//$s_MatKhau=md5($_POST['textMatKhau']); //mã hoá về md5 trước khi nhập xuống csdl	
		$s_Email=$_POST['textEmail'];
        $s_TrangThai=$_POST['selectTrangThai'];
        if(isset($_POST['textMatKhau']))
        {		
    		$s_MatKhau=md5($_POST['textMatKhau']);
    		$sqlstr = "UPDATE user SET TaiKhoan='$s_TaiKhoan',
                                        MatKhau ='$s_MatKhau',									
    									Email='$s_Email',
    									TrangThai=$s_TrangThai WHERE ID =$s_ID"; /*số má ko được để trong nháy đơn*/
                                        
        }
        else{
            $sqlstr = "UPDATE user SET TaiKhoan='$s_TaiKhoan',                                      				
    									Email='$s_Email',
    									TrangThai=$s_TrangThai WHERE ID =$s_ID"; 
        }
		DataProvider::execQuery($sqlstr);
	
	}
	
	//lock/unlock
	
	if(isset($_GET['do']) && isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['do']=='lock' || $_GET['do'] == 'unlock'))
	{
		if($_GET['do']=='lock') //khoá lại
		{
			DataProvider::Khoa_Tai_Khoan($_GET['id']);	
		}
		
		if($_GET['do']=='unlock') //mở khoá
		{
			DataProvider::Mo_Khoa_Tai_Khoan($_GET['id']);		
		}
			
	}
?>

<?php
        //PHÂN TRANG
    	$rowsPerPage=5; //1 lan load 5 trang
		$curPage=1; //trang hien tai
		if(isset($_GET['ppage'])){		
			$curPage = $_GET['ppage']; //trang hiện tại
		}//nếu đường dẫn có truyền page thì tham số page được dùng làm curPage
		$offset=($curPage-1)*$rowsPerPage; //tính offset bắt đầu load
        //------------------------------------------------------------------
        require_once("../DataProvider.php");
        $sqlstr="select * from user  ORDER BY NgayDangKy DESC LIMIT  $offset,$rowsPerPage";      
		             
        
		
		//PHÂN TRANG       
		$number_of_rows=$tong_thanh_vien;	//số lượng record sản phẩm
		$numbers_of_pages=ceil($number_of_rows/$rowsPerPage); //làm tròn lên, vd: 1.4 -> 2
		
		
          
            $result=DataProvider::execQuery($sqlstr); 
            ?>
           
 <div style="width:1000px;border:1px silver solid; margin:0px auto;">
            <table width="998" class="bangdulieu"> <!--BẢNG HIỆN THỊ NHÀ SẢN XUẤT-->
               <thead>
                <tr>
                    <th width="33">ID</th>
                    <th width="167">tài khoản</th>   
                    <th width="151">email</th>   
                    <th width="140">họ tên</th>  
                    <th width="120">ngày sinh</th>    
                    <th width="102">nơi sống</th>     
                    <th width="87">ngày đăng ký</th> 
                    <th width="76">lock/unlock</th>                                                
                    <th width="82">command</th>
                </tr>
             </thead>  
            <?php
            while($row=mysql_fetch_array($result))
            {
            ?>                
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><span class="button2"><?php echo $row['TaiKhoan']; ?></span></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['HoTen']; ?></td>
                    <td><?php echo date('d/m/y',strtotime($row['NgaySinh'])); ?></td>
                    <td><?php echo DataProvider::Lay_Ten_Thanh_Pho($row['NoiSong']); ?></td>
                    <td><?php echo date('d/m/y',strtotime($row['NgayDangKy'])); ?></td>
                    <td>                       
                         <?php if($row['TrangThai']==0) {?> <a class="button4" href="administrator.php?page=thanhvien&do=lock&id= <?php echo $row['ID']; ?>" title="TÀI KHOẢN ĐANG HOẠT ĐỘNG - BẤM VÀO ĐỂ KHOÁ TÀI KHOẢN NÀY"><?php echo "<img src='../skin/img/unlock.png' />"; } ?> </a>
                         <?php if($row['TrangThai']==1) {?><a class="button4" href="administrator.php?page=thanhvien&do=unlock&id= <?php echo $row['ID']; ?>" title="TÀI KHOẢN ĐANG BỊ KHOÁ -  BẤM VÀO ĐỂ MỞ KHOÁ TÀI KHOẢN NÀY"><?php echo "<img src='../skin/img/locked.png' />"; }?> </a>
                       
                    </td>
                    
                    <td>
                    
                    <a href="administrator.php?page=thanhvien&do=sua&id=<?php echo $row['ID']; ?>" title="SỬA THÔNG TIN THÀNH VIÊN NÀY" ><img src="../skin/img/edit.gif" />
                      
                    <a href="administrator.php?page=thanhvien&do=xoa&id=<?php echo $row['ID']; ?>" title="XOÁ THÀNH VIÊN NÀY" onclick="return confirm('bạn có chắc muốn xoá');"><img src="../skin/img/xdelete.png" /></a>
                 
                 	 </td>	   
                </tr>
            <?php   				
            }
			?>
			<tr><td colspan="9">
        <?php

				for($page=1; $page<=$numbers_of_pages;$page++) //phải <= vì lấy trang cuối
				{
					//không xuất liên kết cho trang hiện tại
					if($page==$curPage)
					{
						echo "<strong class='button3'>$page</strong>&nbsp;&nbsp;";
					}
					else echo "<a class='button4' href='administrator.php?page=thanhvien&ppage=$page'>$page</a>&nbsp;&nbsp;";
				}
			 
    ?>
          </td>		   
      </tr>
    </table> <!--END: BẢNG HIỆN THỊ LOẠI ĐỒ CHƠI-->
  

 </div>

<div class="clear"></div>
<script type="text/javascript" src="file/js/form/check_form_thanhvien.js"></script>

 <div id="form_dochoi" style="width:650px; margin:10px auto; visibility:hidden;">
     <form name="form1" method="post" action="administrator.php?page=thanhvien"  autocomplete="off" onsubmit="return check_form_thanhvien(this);">
       <div align="center">
         <table width="650px" class="bangdulieu">
           <tr>
             <td colspan="3" bgcolor="#CCCCCC"><div align="center">editor</div></td>
           </tr>
           <tr>
             <td><div align="right">ID</div></td>
             
             <td><input type="hidden" name="hiddenID" id="hiddenField" value="<?php echo ($flag==true)?$s_ID:''; ?>"/>
             <input class="button4" name="hienthiID" type="button"  id="textID2" value="<?php echo ($flag==true)?$s_ID:'auto'; ?>"/></td>
             <td width="1" rowspan="8">&nbsp;</td>
           </tr>
           <tr>
             <td width="159" height="46"><div align="right"><?php echo (isset($_GET['do']) && $_GET['do']=='sua')?'thay đổi tài khoản':'tài khoản';?></div></td>
             <td width="404"><input type="text" name="textTaiKhoan" id="textTaiKhoan" value="<?php echo ($flag==true)?$s_TaiKhoan:''; ?>"/></td>
           </tr>
           <tr>
             <td height="46"><div align="right"><?php echo (isset($_GET['do']) && $_GET['do']=='sua')?'đặt lại mật khẩu':'mật khẩu';?></div></td>
             
             <script>
		 	function BatTatTextMatKhau(s)
			{
				if(s.disabled==true)
				{				
					s.disabled=false;
				}
				else
				{
					s.disabled=true;	
				}
			}
		 </script>
             <td><input name="textMatKhau"  type="password" <?php echo (isset($_GET['do']) && $_GET['do']=='sua')?"disabled='disabled'":''; ?>" id="textMatKhau" /> 			            <?php if(isset($_GET['do'])&& $_GET['do']=='sua'){?>
               <input type="checkbox" name="checkboxDatLaiMatKhau" id="checkboxDatLaiMatKhau" onclick="BatTatTextMatKhau(textMatKhau);"/>
               <?php }?>
               
             </td>
           </tr>
           <?php 
        
			if(isset($_GET['do']) && $_GET['do'] == 'them')
			{?>
           <!--HIỆN COMBOBOX NGÀY SINH-->
           <tr>
             <td><div align="right">họ tên</div></td>
             <td><input type="text" name="textHoTen" id="textHoTen" /></td>
           </tr>
           <tr>
             <td><div align="right">ngày sinh</div></td>
             <td>
               <select name="selectNgay" id="selectNgay" style="width:80px;"/>
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
                        	?></select>
               
               
               <select name="selectThang" id="selectThang" style="width:100px;" />
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
                            ?></select>
               
               <select name="selectNam" id="selectNam" style="width:90px;"/>
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
                                ?> </select>
               </td>
             </tr>
           <!--HIỆN COMBOBOX NƠI SỐNG-->
           <tr>
             <td><div align="right">nơi sống</div></td>
             
             <td>
               <select name="selectNoiSong" id="selectNoiSong">
                 <option value='-1'>-- nơi sống --</option>
                 <?php
                                $strql="select * from thanhpho";
                                $result=DataProvider::execQuery($strql);
                                while($row = mysql_fetch_array($result))
                                {?>
                 <option value="<?php echo $row[0]; ?>" <?php echo ($flag && $selectNoiSong==$row[0])?'selected':''; ?>><?php echo $row[1]; ?></option><?php } ?>
                 </select>
               </td>
             </tr>
           <?php }	/*end*/	
		?>
           
           <tr>
             <td height="46"><div align="right"><?php echo (isset($_GET['do']) && $_GET['do']=='sua')?'thay đổi email':'email';?></div></td>
             <td><input type="text" name="textEmail" id="textEmail" value="<?php echo ($flag==true)?$s_Email:''; ?>"/></td>
           </tr>
           <tr>
             <td height="62"><div align="right"><?php echo (isset($_GET['do']) && $_GET['do']=='sua')?'thay đổi trạng thái':'trạng thái';?></div></td>
             <td><select name="selectTrangThai" id="selectTrangThai">
               <option value="0"  <?php echo ($flag==true && $s_TrangThai==0)?'selected':''; ?>>hoạt động bình thường</option>
               <option value="1" <?php echo ($flag==true && $s_TrangThai==1)?'selected':''; ?>>bị khoá</option>
             </select></td>
           </tr>
           
           
           <tr>
             <td colspan="3">
               <div align="right"></div>
               <div align="center">
                 <?php if(isset($_GET['do']) && $_GET['do']=='them') {?>
                 <input class="button3" type="submit" name="buttonThem" id="buttonThem" value="thêm thành viên" />
                 <?php } else if(isset($_GET['do']) && $_GET['do']=='sua'){?>
                 <a class="button1" href="administrator.php?page=thanhvien">huỷ cập nhật này</a>
                 <?php } ?>
                 
                 <?php if(isset($_GET['do']) && $_GET['do']=='sua'){ ?><input class="button3" type="submit" name="buttonSua" id="buttonSua" value="cập nhật" /> 
                 <?php } ?>          
              </div></td>
           </tr>
         </table>
       </div>
    </form>

 
 </div>
 
  <div class="clear"></div>
  
   </div> <!--DIV TỔNG---?