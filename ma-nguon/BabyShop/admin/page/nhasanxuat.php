<div style="position:relative;">
  <?php 
  $tong_san_pham=DataProvider::So_Luong_Nha_San_Xuat_Trong_CSDL();  
  echo '<div>tất cả: ('.$tong_san_pham.') nhà sản xuất</div>';           
   ?>
  <hr />
    <div style="wposition: relative; width:150px; padding:15px;  margin:0px auto;">
    	 <a href="administrator.php?page=nhasanxuat&do=them"> <input class="chucnang" type="submit" name="buttonThemAnHien" id="buttonThemAnHien" value="thêm nhà sản xuát mới"/></a>
   	 
    </div>
  <div align="center">
  <?php
	//thêm----------------------------------------------------------------------
	if(isset($_POST['buttonThem']))
	{
		$textTenNSX=$_POST['textTenNSX'];
        //nếu file up không tồn tại thì gán cho nó một ảnh rỗng
		$textHinhAnh=($_POST['textHinhAnh']!='' && file_exists("../img/".$_POST['textHinhAnh']))?$_POST['textHinhAnh']:'do-choi/no-photo.jpg';               
		$textThongTin=$_POST['textThongTin'];
		
		$sqlstr="INSERT INTO nhasanxuat(TenNSX,ThongTin,HinhAnh,NgayThem)values('$textTenNSX','$textThongTin','$textHinhAnh',NOW())";				
        DataProvider::execQuery($sqlstr);
        header("location:administrator.php?page=nhasanxuat");
    			
	}
	//xoá
	
	if(isset($_GET['do']) && isset($_GET['id']))
	{
		if($_GET['do']=='xoa' && (is_numeric($_GET['id'])==true))
		{
		 
				$duongdananhxoa = DataProvider::Xoa_Mot_Nha_San_Xuat($_GET['id']); //xoá xong trả về đường dẫn của bức ảnh
                /*
                //XOÁ LUÔN FILE ảnh CỦA NÓ NẾU TỒN TẠI, KHÔNG XOÁ ẢNH MẶC ĐỊNH
                 $strql="select ID from nhasanxuat where hinhanh = '$duongdananhxoa'";
                $result=DataProvider::execQuery($sqlstr);
                if(mysql_num_rows($result)==1) //NẾU CHỈ CÓ MÌNH NÓ CÓ ẢNH NÀY MỚI XOÁ, PHÒNG KHI SẢN PHẨM DÙNG CHUNG ẢNH THÌ KHÔNG XOÁ
                {
                    if(file_exists("../img/$duongdananhxoa") && $duongdananhxoa!='nha-san-xuat/no-photo.jpg') 
                    {
                        $del="../img/$duongdananhxoa";
                         unlink($del); //xoá nó
                    }
                }*/
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
				$s_tenNSX="";
				$s_hinhanh="";
				$s_thongtin="";								
					/*LẤY RA THÔNG TIN CỦA ĐỒ CHƠI ĐANG CẦN SỬA*/
					$sqlstr="select * from nhasanxuat where id = $ID";
					
					$result=DataProvider::execQuery($sqlstr);
					$row=mysql_fetch_array($result);
					if(count(mysql_num_rows($result))>0)
					{
							$s_ID=$row['ID'];
							$s_tenNSX=$row['TenNSX'];
							$s_hinhanh=$row['HinhAnh'];
							$s_thongtin=$row['ThongTin'];						
							$flag=true; //đã móc được
					}
		}
	}
	//sửa //nếu người dùng bấm vào nút button sửa
	if(isset($_POST['buttonSua']))
	{	
	  
		$s_ID=$_POST['hiddenID'];
		$s_tenNSX=$_POST['textTenNSX'];
		$s_hinhanh=$_POST['textHinhAnh'];
		$s_thongtin=$_POST['textThongTin'];		


		$sqlstr = "UPDATE nhasanxuat SET 
										TenNSX='$s_tenNSX',
										HinhAnh='$s_hinhanh',
										ThongTin='$s_thongtin'	WHERE ID =$s_ID";
		DataProvider::execQuery($sqlstr);
	

		header("location:administrator.php?page=nhasanxuat");
			
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

        $sqlstr="SELECT * FROM nhasanxuat";
        //------------------------------------------------------------------
        require_once("../DataProvider.php");
        $sqlstr="select * from nhasanxuat  order by ngaythem DESC limit $offset,$rowsPerPage";      
		             
        
		
		//PHÂN TRANG
        $result2=DataProvider::execQuery($sqlstr);
		$number_of_rows=DataProvider::So_Luong_Nha_San_Xuat_Trong_CSDL();	//số lượng record sản phẩm
		$numbers_of_pages=ceil($number_of_rows/$rowsPerPage); //làm tròn lên, vd: 1.4 -> 2
		
		
        if($tong_san_pham>0)
        {
             
            $result=DataProvider::execQuery($sqlstr); 
            ?>
      
  </div>
  <div style="border:1px silver solid; margin:15p auto;">
      <div align="center">
        <table width="910" class="bangdulieu"> 
          <!--BẢNG HIỆN THỊ NHÀ SẢN XUẤT-->
          <thead>
            <tr>
              <th width="23" height="66">ID</th>
              <th width="147">tên nhà sản xuất</th>
              <th width="39">hình ảnh</th>
              <th width="480">thông tin</th>
              <th width="36">sl sản phẩm</th>
              <th width="157">command</th>
            </tr>
          </thead>  
          <?php
            while($row=mysql_fetch_array($result))
            {
            ?>                
          <tr>
            <td><?php echo$row['ID']; ?></td>
            <td><span class="button2"><?php echo $row['TenNSX']; ?></span></td>
            <td><img width="35px" src="./../img/<?php echo $row['HinhAnh']; ?>" /></td>               
            <td><div style="max-width: 100%; max-height:70; overflow: auto; font-size:8pt; font-family:arial; color:#008040;"><?php echo $row['ThongTin']; ?></div></td>
            <td><?php echo DataProvider::So_Luong_San_Pham_Cua_Mot_NSX($row['ID']); ?></td>
            
            
            <td>
              
              <a href="administrator.php?page=nhasanxuat&do=sua&id=<?php echo $row['ID']; ?>" title="sửa sản phẩm này" ><img src="../skin/img/edit.gif" />
                
              <!------CHỈ HIỆN NÚT XOÁ XOÁ NSX NẾU SỐ LƯỢNG SP CỦA HỌ =0 ----->
               <?php if(DataProvider::So_Luong_San_Pham_Cua_Mot_NSX($row['ID'])==0){?>      
              <a href="administrator.php?page=nhasanxuat&do=xoa&id=<?php echo $row['ID']; ?>" title="xoá sản phẩm này" onclick="return confirm('bạn có chắc muốn xoá');"><img src="../skin/img/xdelete.png" /></a>
              <?php } else{?>
              <a href="javascript:void(0);" title="không thể xoá" onclick="alert('không thể xoá NSX này vì đang tồn tại số lượng sản phẩm của họ');"><img src="../skin/img/lock_delete.png" /></a>
              <?php }?>
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
					else echo "<a class='button4' href='administrator.php?page=nhasanxuat&ppage=$page'>$page</a>&nbsp;&nbsp;";
				}
	    ?>
            </td>		   
          </tr>
        </table> <!--END: BẢNG HIỆN THỊ NHÀ SẢN XUẤT-->
        
        <?php   
     }         
?>
      </div>
  </div>



 <div id="form_dochoi" style="border:1px silver dashed;  margin:15p auto; visibility:hidden;">
 <script type="text/javascript" src="file/js/form/check_form_nhasanxuat.js"></script>  
 	
    <form id="form_nhasanxuat" name="form_nhasanxuat" method="post" action="" >
      <div align="center">
        <table width="782" class="bangnhaplieu">
          <tr>
            <td colspan="3" bgcolor="#CCCCCC"><div align="center">EDITOR</div></td>
          </tr>
          <tr>
            <td>ID</td>
            <td><input type="hidden" name="hiddenID" id="hiddenField" value="<?php echo ($flag==true)?$s_ID:''; ?>" /><input class="button4" name="hienthiID" type="button"  id="textID2" value="<?php echo ($flag==true)?$s_ID:'auto'; ?>"/></td>
            <td width="223" rowspan="4">
              <?php echo ($flag==true)?"<img width='120p' src='../img/".$s_hinhanh."'/>":''; ?>
              
            </td>
          </tr>
          <tr>
            <td width="213" height="46"><div align="right"><label>tên nhà sản xuất</label></div></td>
            <td width="330"> <div style="margin-left:15px;">  <input type="text" name="textTenNSX" id="textTenNSX" value="<?php echo ($flag==true)?$s_tenNSX:''; ?>" /></div></td>
          </tr>
          <tr>
            <td height="46"><div align="right"><label>mô tả thông tin</label></div></td>
            <td>
             <div style="margin-left:15px;">           
               <textarea name="textThongTin" id="textThongTin" rows="10" cols="50"><?php echo ($flag==true)?$s_thongtin:''; ?></textarea><br />
                         <script language="javascript1.2">make_wyzz('textThongTin');</script>
           </div></td>
          </tr>
          <tr>
            <td height="62"><div align="right"><label>hình ảnh</label></div></td>
            <td><input name="textHinhAnh" type="text" id="textHinhAnh" size="20" value="<?php echo ($flag==true)?$s_hinhanh:''; ?>" />
              
            <input type="button" class="button2" name="buttonBrowser" id="buttonBrowser" value="...chọn" onclick="openUploader2();"/></td>
          </tr>
          <tr>
            <td colspan="3"><div align="right"></div>
              <div align="center">
                <?php if(isset($_GET['do']) && $_GET['do']=='them') {?>
             <input class="button3" type="submit" name="buttonThem" id="buttonThem" value="thêm" onclick="return check_form_nhasanxuat(form_nhasanxuat);"/>
                <?php } else if(isset($_GET['do']) && $_GET['do']=='sua'){?>
                <a class="button1" href="administrator.php?page=nhasanxuat">huỷ cập nhật này</a>
                <?php } ?>
                
                <?php if(isset($_GET['do']) && $_GET['do']=='sua'){ ?>
                <input class="button3" type="submit" name="buttonSua" id="buttonSua" value="cập nhật" onclick="return check_form_nhasanxuat(form_nhasanxuat);"/> 
                <?php } ?>          
             </div></td>
          </tr>
        </table>
      </div>
    </form>

 
 </div>
 
  <div class="clear"></div>
  
   </div> <!--DIV TỔNG---?