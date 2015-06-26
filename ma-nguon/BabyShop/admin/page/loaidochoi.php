<div style="position:relative;">
  <?php 
  $tong_san_pham=DataProvider::So_Luong_Loai_Do_Choi_Trong_CSDL(); 
  echo '<div>tất cả: ('.$tong_san_pham.') thể loại đồ chơi</div>';           
   ?>
  <hr />

  <div style="wposition: relative; width:150px; padding:15px;  margin:0px auto;">
    	 <a href="administrator.php?page=loaidochoi&do=them"> <input class="chucnang" type="submit" name="buttonThemAnHien" id="buttonThemAnHien" value="thêm loại đồ chơi mới"/></a>
   	 
    </div>
<?php
	//thêm----------------------------------------------------------------------

	if(isset($_POST['buttonThem']))
	{	
		$textTenLoaiDoChoi=$_POST['textTenLoaiDoChoi'];
		$textThongTin=($_POST['textThongTin']!='')?$_POST['textThongTin']:'chưa có thông tin';
		
		$sqlstr="INSERT INTO loaidochoi(TenLoaiDoChoi,ThongTin,NgayThem)values('$textTenLoaiDoChoi','$textThongTin',NOW())";				
        DataProvider::execQuery($sqlstr);
       
	}
	//xoá
	if(isset($_GET['do']) && isset($_GET['id']))
	{
		if($_GET['do']=='xoa' && (is_numeric($_GET['id'])==true))
		{
		   $sqlstr="DELETE FROM loaidochoi WHERE ID=".$_GET['id'];  	
	       DataProvider::execQuery($sqlstr);
           header("location:administrator.php?page=loaidochoi");
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
				$s_tenloaidochoi="";	
				$s_thongtin="";								
					/*LẤY RA THÔNG TIN CỦA ĐỒ CHƠI ĐANG CẦN SỬA*/
					$sqlstr="select * from loaidochoi where id = $ID";
					
					$result=DataProvider::execQuery($sqlstr);
					$row=mysql_fetch_array($result);
					if(count(mysql_num_rows($result))>0)
					{
							$s_ID=$row['ID'];
							$s_tenloaidochoi=$row['TenLoaiDoChoi'];							
							$s_thongtin=$row['ThongTin'];						
							$flag=true; //đã móc được
					}
		}
	}
	//sửa //nếu người dùng bấm vào nút button sửa
	if(isset($_POST['buttonSua']))
	{	
		$s_ID=$_POST['hiddenID'];
		$s_tenLoaiDoChoi=$_POST['textTenLoaiDoChoi'];
		$s_thongtin=$_POST['textThongTin'];
	
		$sqlstr = "UPDATE loaidochoi SET 
										TenLoaiDoChoi='$s_tenLoaiDoChoi',
										ThongTin='$s_thongtin'	WHERE ID =$s_ID";
		DataProvider::execQuery($sqlstr);
	

		header("location:administrator.php?page=loaidochoi");
			
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
        $sqlstr="select * from loaidochoi order by ngaythem DESC limit $offset,$rowsPerPage";      
		             
        
		
		//PHÂN TRANG       
		$number_of_rows=$tong_san_pham;	//số lượng record sản phẩm
		$numbers_of_pages=ceil($number_of_rows/$rowsPerPage); //làm tròn lên, vd: 1.4 -> 2
		
		
        if($tong_san_pham>0)
        {
             
            $result=DataProvider::execQuery($sqlstr); 
            ?>
           
 <div style="width:85%;border:1px silver solid; margin:0px auto;">
            <table width="925" class="bangdulieu"> <!--BẢNG HIỆN THỊ NHÀ SẢN XUẤT-->
               <thead>
                <tr>
                    <th width="32">ID</th>
                    <th width="136">tên loại đồ chơi</th>    
                    <th width="178">thông tin</th>                 
                    <th width="80">command</th>
                </tr>
             </thead>  
            <?php
            while($row=mysql_fetch_array($result))
            {
            ?>                
                <tr>
                    <td><?php echo$row['ID']; ?></td>
                    <td><span class="button2"><?php echo $row['TenLoaiDoChoi']; ?></span></td>
                    <td><div style="max-height:100px; max-width:150px;overflow: auto;"><?php echo $row['ThongTin']; ?></div></td>  
                    <td>
                    
                    <a href="administrator.php?page=loaidochoi&do=sua&id=<?php echo $row['ID']; ?>" title="sửa loại đồ chơi này" ><img src="../skin/img/edit.gif" />
                      
                    <!------CHỈ HIỆN NÚT XOÁ XOÁ NSX NẾU SỐ LƯỢNG SP CỦA HỌ =0 ----->
                    
                    <a href="administrator.php?page=loaidochoi&do=xoa&id=<?php echo $row['ID']; ?>" title="xoá loại đồ chơi này" onclick="return confirm('bạn có chắc muốn xoá');"><img src="../skin/img/xdelete.png" /></a>
                 
                 	 </td>	   
                </tr>
            <?php   				
            }
			?>
			<tr><td colspan=12>
        <?php

				for($page=1; $page<=$numbers_of_pages;$page++) //phải <= vì lấy trang cuối
				{
					//không xuất liên kết cho trang hiện tại
					if($page==$curPage)
					{
						echo "<strong class='button3'>$page</strong>&nbsp;&nbsp;";
					}
					else echo "<a class='button4' href='administrator.php?page=loaidochoi&ppage=$page'>$page</a>&nbsp;&nbsp;";
				}
			 
    ?>
          </td>		   
      </tr>
    </table> <!--END: BẢNG HIỆN THỊ LOẠI ĐỒ CHƠI-->
  
<?php   
     }         
?>
 </div>


<script type="text/javascript" src="file/js/form/check_from_loaidochoi.js"></script>  
 <div id="form_dochoi" style="width:85%;margin:10px auto; visibility:hidden;">
     <form name="form_loaidochoi" method="post" action="administrator.php?page=loaidochoi">
     <table width="837" class="bangnhaplieu">
       <tr>
         <td colspan="3" bgcolor="#CCCCCC"><div align="center">CHỈNH SỬA THÔNG TIN</div></td>
       </tr>
       <tr>
         <td><div align="right">ID</div></td>
         <td><input type="hidden" name="hiddenID" id="hiddenField" value="<?php echo ($flag==true)?$s_ID:''; ?>"/>
         <div style="margin-left:30px;"><input class="button4" name="hienthiID" type="button"  id="textID2" value="<?php echo ($flag==true)?$s_ID:'auto'; ?>"/></div></td>
         <td width="2" rowspan="4">&nbsp;</td>
       </tr>
       <tr>
         <td width="171" height="46"><div align="right">tên loại đồ chơi<code>(*)</code></div></td>
         <td width="365"><input type="text" name="textTenLoaiDoChoi" id="textTenLoaiDoChoi" value="<?php echo ($flag==true)?$s_tenloaidochoi:''; ?>"/></td>
       </tr>
       <tr>
         <td height="46"><div align="right">mô tả thông tin</div></td>
         <td>
         <div style="margin-left:15px;">
         <textarea name="textThongTin" id="textThongTin" rows="10" cols="50"><?php echo ($flag==true)?$s_thongtin:''; ?></textarea><br /></div>
                         <script language="javascript1.2">make_wyzz('textThongTin');</script></td>
       </tr>
       <tr>
         <td height="62" colspan="2"><div align="center">
           <?php if(isset($_GET['do']) && $_GET['do']=='them') {?>
           <input class="button3" type="submit" name="buttonThem" id="buttonThem" value="thêm" onclick="return check_form_loaidochoi(form_loaidochoi);" />
           <?php } else if(isset($_GET['do']) && $_GET['do']=='sua'){?>
           <a class="button1" href="administrator.php?page=loaidochoi">huỷ cập nhật này</a>
           <?php } ?>
           <?php if(isset($_GET['do']) && $_GET['do']=='sua'){ ?>
           <input class="button3" type="submit" name="buttonSua" id="buttonSua" value="cập nhật" onclick="return check_form_loaidochoi(form_loaidochoi);"/>
           <?php } ?>
          </div></td>
       </tr>
       </table>
  </form>

 
 </div>
 
  <div class="clear"></div>
  
   </div>
<!--DIV TỔNG---?