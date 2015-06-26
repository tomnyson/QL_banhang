<div style="position:relative;">
  <?php 
  $tongdonhang=DataProvider::So_Luong_Don_Hang_Trong_CSDL();
  
  $chuagiao = DataProvider::So_Luong_Don_Hang_Chua_Giao_Trong_CSDL();
  echo '<div>tất cả: ('.$tongdonhang.') đơn hàng - có <span style="color:red">('.$chuagiao.')</span> đơn hàng chưa giao cho khách</div>';     
        
   ?>
    <hr />
  



<!----------------------------------->

<?php /*XOÁ BỎ 1 ĐƠN HÀNG*/
if(isset($_GET['do']) && $_GET['do']=='xoadonhang' && isset($_GET['id']))
{
	$sqlstr="delete from donhang where Id = ".$_GET['id'];		
	DataProvider::execQuery($sqlstr);
	header("location:administrator.php?page=donhang");
}	
 /*ĐÁNH DẤU CHƯA GIAO HÀNG*/
if(isset($_GET['do']) && $_GET['do']=='danhdauchuagiaohang' && isset($_GET['id']))
{
	$sqlstr="update donhang set TrangThai = 0 where ID = ".$_GET['id'];		
	DataProvider::execQuery($sqlstr);
	header("location:administrator.php?page=donhang");
}	


 /*ĐÁNH DẤU ĐÃ GIAO HÀNG*/
if(isset($_GET['do']) && $_GET['do']=='danhdaudagiaohang' && isset($_GET['id']))
{
		$sqlstr="update donhang set TrangThai = 1 where ID = ".$_GET['id'];			
	DataProvider::execQuery($sqlstr);
	header("location:administrator.php?page=donhang");
}	
?>


<!--------------------------------------------------------------------------------------------->
<?php

//PHÂN TRANG
    	$rowsPerPage=10; //1 lan load 5 trang
		$curPage=1; //trang hien tai
		if(isset($_GET['ppage'])){		
			$curPage = $_GET['ppage']; //trang hiện tại
		}//nếu đường dẫn có truyền page thì tham số page được dùng làm curPage
		$offset=($curPage-1)*$rowsPerPage; //tính offset bắt đầu load				
		
	$sqlstr="select * from donhang order by TrangThai,NgayDatHang limit $offset,$rowsPerPage";
//PHÂN TRANG       
		$number_of_rows=$tongdonhang;	//số lượng record sản phẩm
		$numbers_of_pages=ceil($number_of_rows/$rowsPerPage); //làm tròn lên, vd: 1.4 -> 2
	
	
    $result=DataProvider::execQuery($sqlstr);
    ?>
    <table width="1059" class="bangdulieu" style="font-size:9pt;">
    <tr>
        <th width="33" height="75">mã đơn hàng</th>
        <th width="56">tên khách hàng</th>
        <th width="50">thông tin liên lạc</th>     
        <th width="188">địa chỉ giao hàng</th>
        <th width="375">các sản phẩm</th>
        <th width="115">ngày đặt hàng</th>      
        <th width="176">trạng thái</th>
    </tr>
    <?php
	
		
	
    while($row = mysql_fetch_array($result)){?>    
   		<tr <?php if($row['TrangThai']==1) echo "style='background:gray; color:	#dddddd;'"; ?>>
        <td><?php echo $row[0]; ?></td>
        <td><span class="button2none"><?php echo $row['TenKhachHang']; ?></span></td>
        <td>
			<?php echo $row['Email']; ?><br />
      		<h3><img src="../skin/img/contact_mini.png" width="25px"/> <?php echo $row['SoDienThoai']; ?></h3><br />
        </td>
        
        <td><div style="width:120px;"><?php echo $row['DiaChiNhanHang']; ?></div></td>       
       
        <?php			
			$mang_sanpham = explode("/",$row['DanhSachSanPham']);
			$mang_soluongsanpham= explode("/",$row['DanhSachSoLuong']);
			$donhang_sanpham=array();
			for($i = 0; $i<count($mang_sanpham); $i++)
			{
				$donhang_sanpham[$mang_sanpham[$i]]=$mang_soluongsanpham[$i];	
			}
		?>	
            <td>
            	<!------BẢNG SẢN PHẨM KHÁCH HÀNG ĐÃ ĐẶT--------->
            	<table width="370">
                    <tr>
                    	<th width="32">mã SP</th> 
                        <th width="223">tên</th> 
                        <th width="43">giá bán</th>
                        <th width="39">số lượng</th> 
                        <th width="52">thành tiền</th>
                    </tr>
                  	   <?php
                 $tongtien=0;
				 $trangthai=0;
                 foreach($donhang_sanpham as $masanpham => $soluong)
                 {	
					 /*xuất các thông tin cần thiết của sản phẩm nàu*/
					 $mang_chitiet=DataProvider::Tra_Ve_Thong_Tin_1_Mon_Do_Choi($masanpham);
					 echo"<tr>";
                   	 echo("<td>".$masanpham."</td>");	
					 echo("<td><a href='../index.php?page=detail&MaSanPham=".$masanpham."' target='_blank'>".$mang_chitiet['TenDoChoi']."</a></td>");
					  echo("<td>".number_format($mang_chitiet['GiaBan'])."</td>");
					 echo("<td>".$soluong."</td>");
					 echo("<td>".number_format($mang_chitiet['GiaBan']*$soluong)."</td>");
					 echo"</tr>";  
					 $tongtien+=$mang_chitiet['GiaBan']*$soluong;
                 }	
                echo "<td colspan='5'  bgcolor='#FFFF00'>TỔNG TIỀN: ".number_format($tongtien)."VNĐ </td>";           
                ?>      
                </table>
                <!------END BẢNG SẢN PHẨM KHÁCH HÀNG ĐÃ ĐẶT--------->
          </td>
          <td><?php echo date("h:i d/m/Y",strtotime($row['NgayDatHang'])); ?></td>
          
           <td>
           		
	         <table width="163" border="0" >
   		          <tr >
   		            <td width="113" bgcolor="#88CBEC" style="font-size:15px; font-weight:bold;">
                    <p>
           		  <?php
				 if($row['TrangThai']==0)
				 {	
				 	echo("<span style='color:red;'>chưa giao hàng</span>  <img src='../skin/img/clock.png' />");
				 }
				 else if($row['TrangThai']==1)
				 {
					 echo("<span style='color:gray;'>đã giao hàng</span> <img width='32px' src='../skin/img/success.png' />");
				 }	
				 else{
					echo("đơn hàng này đã bị huỷ  <img src='../skin/img/xdelete.png' />");	 
				 }
				  ?>
           		  
           		  <!-----LỆNH---->
           		  
           		 
	       </p>
               </td>
               </tr>
   		          <tr>
   		            <td>                    
                    	<ul class="ul_lenh_donhang">
                        	<?php if($row['TrangThai']==0){?>
                        	<a href="administrator.php?page=donhang&do=danhdaudagiaohang&id=<?php echo $row['ID'];?>"><li><img width="15px" src="../skin/img/check.png" />đánh dấu đã giao hàng</li></a>
                            <?php } ?>
                            
                            
                            <?php if($row['TrangThai']==1){?>
                            <a href="administrator.php?page=donhang&do=danhdauchuagiaohang&id=<?php echo $row['ID'];?>"><li><img width="15px" src="../skin/img/loading3.gif" /> đánh dấu chưa giao hàng</li></a>
                             <?php } ?>
                             
                             
                             <a onclick="return confirm('bạn có chắc muốn xoá đơn hàng này?');" href="administrator.php?page=donhang&do=xoadonhang&id=<?php echo $row['ID'];?>">
                             <li> <img width="10px" src="../skin/img/xdelete.png" /> xoá bỏ</li></a>
                             
                             
                        </ul>
                    </td>
               </tr>
             </table>
          <p>&nbsp;</p></td>
      </tr>
<?php 
  }    
?>
</table>
    <?php

				for($page=1; $page<=$numbers_of_pages;$page++) //phải <= vì lấy trang cuối
				{
					//không xuất liên kết cho trang hiện tại
					if($page==$curPage)
					{
						echo "<strong class='button3'>$page</strong>&nbsp;&nbsp;";
					}
					else echo "<a class='button4' href='administrator.php?page=donhang&ppage=$page'>$page</a>&nbsp;&nbsp;";
				}
			 
    ?>
