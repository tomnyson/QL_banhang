<img src="skin/img/bag.png" style="position:absolute; top:5px; right:5px;" width="35px"/>
<?php
	if(isset($_POST['buttonDatHang']) && $_POST['buttonDatHang']=="đặt hàng")
	{	 
		
			var_dump($_REQUEST);
			$textTenKhachHang=$_POST['textTenKhachHang'];
			$textSoDienThoai=$_POST['textSoDienThoai'];
			$textEmail=$_POST['textEmail'];
			$textDiaChiNhanHang=$_POST['textDiaChiNhanHang'];	
			$chuoisanpham=implode("/",$_SESSION['giohang_ID']);
			$danhsachsoluongtungsanpham=$_POST['hiddenSoLuongTungSanPham'];
			//
			$sqlstr="INSERT INTO donhang(TenKhachHang,SoDienThoai,Email,DiaChiNhanHang,NgayDatHang,DanhSachSanPham,DanhSachSoLuong)
					VALUES('$textTenKhachHang','$textSoDienThoai','$textEmail','$textDiaChiNhanHang',NOW(),'$chuoisanpham','$danhsachsoluongtungsanpham')";
			DataProvider::execQuery($sqlstr);
			
			//QUAN TRỌNG - TĂNG SỐ LƯỢng đã BÁN CỦA CÁC SẢN PHẨM LÊN
			$chuoisanpham=$_SESSION['giohang_ID'];
			$danhsachsoluongtungsanpham=explode("/",$_POST['hiddenSoLuongTungSanPham']);
			for($i=0; $i<count($chuoisanpham);$i++)
			{
				DataProvider::Tang_So_Luong_Da_Ban_Duoc($chuoisanpham[$i],$danhsachsoluongtungsanpham[$i]);
				
			}
			unset($_SESSION['giohang_ID']); // xoá hết hàng trong giỏ hàng
			header("location:index.php");
	}

?>
<?php echo("<div class='tieude_giohang'>có ".count($_SESSION['giohang_ID'])." sản phẩm trong giỏ hàng</div>"); ?>
<div class="quaytinhtien_giohang">
    <?php
	
	$tong_tien=0;
	$mang_sanpham=array();
	$mang_sanpham=$_SESSION['giohang_ID'];	
	
	$mang_giatien=array();
	$mang_soluong=array();

   //THỐNG KÊ SỐ LƯỢNG SẢN PHẨM TRONG GIỎ HÀNG
    if (isset($_SESSION['giohang_ID'])) 
    {     
        $_SESSION['giohang_ID']=array_filter($_SESSION['giohang_ID']);
       
        if(count($_SESSION['giohang_ID'])>0)
        {
            ?>
                <div class="chucnang_giohang">
                    <ul>
                       
                        <table width="906" height="80" border="0">
                          <tr>
                            <td width="444" rowspan="3" class="chucnang_giohang2">
                             <a href="javascript:void(0);" onclick="xoa_het_gio_hang(); $('.chucnang_giohang2,#result').fadeOut();"><li class="xoa"><img width="18px" src="skin/img/xclose.png"/> XOÁ TẤT CẢ</li></a>
                             <a href="javascript:void(0);" onclick="thanh_toan_tien();" id="button_thanhtoan">
                             <li><img width="18px" src="skin/img/pay.png"/> THANH TOÁN</li></a></td>
                            <td width="452" height="30"><div align="center">tổng cộng</div></td>
                          </tr>
                          <tr>
                            <td height="18">
                            <script>
								$(document).ready(function() {
                                    $("#buttonDatHang").click(function(){
										alert("x");
									});
                                });
							</script>
                             <script src="js/doc_so_tien.js">/*hàm đọc số tiền*/</script>
                             <script src="js/giohang.js">/*hàm xử lý*/</script>
                            <script>/*TÍNH TỔNG TIỀN*/
										$(document).ready(function(e) {
                                            tinhlaitien();
                                        });	
                            </script>                           
                                    <div style="text-align:center;">
                                      <div align="center">
                                      <span id="tong_tien" class="tiente"></span> VNĐ</div>
                                    </div>
                                  
                               		<span id="so_luong_san_pham" style="visibility:hidden;"></span>
                            		
                            </td>
                          </tr>
                          <tr>
                                   <td>
                               <p class="doc_tien" style="text-align:center;color:#999999;font-style:italic;"></p>        
                                    </td>
                          </tr>
                        </table>
                       
                  </ul>
                </div>
            <?php
        }
    }   
    ?>
</div>

<?php 
  
    //XOÁ HẾT DỮ LIỆU TRONG GIỎ HÀNG   
     if(isset($_GET['do']) && $_GET['do']=='xoahetgiohang')
     {
        unset($_SESSION['giohang_ID']);
        header("location:index.php?page=giohang");
     }
   
    //XOÁ 1 SẢN PHẨM ĐANG CHỌN   
     if(isset($_GET['do']) && $_GET['do']=='xoa1sanpham')
     {
            if(isset($_GET['id']) && in_array($_GET['id'],$_SESSION['giohang_ID'])) //nếu sản phẩm này nằm trong giỏ hàng
            {
                    $i = array_search($_GET['id'],$_SESSION['giohang_ID']);
                    {        
                        $_SESSION['giohang_ID'][$i]=null;          
                        $_SESSION['giohang_ID']=array_filter($_SESSION['giohang_ID']);             
                        header("location:index.php?page=giohang");
                    }
                 
            }                       
        
     }
   ?>
   	<div id="result" class="thongbao2"></div>
   
   <?php     
    //XUẤT TOÀN BỘT THÔNG TIN SẢN PHẨM TRONG GIỎ HÀNG
    if(isset($_SESSION["giohang_ID"]) && count($_SESSION["giohang_ID"])>0)
    {
            foreach($_SESSION['giohang_ID'] as $k => $v) /*nếu dùng for --> count(session) thì sai, vì khi xoá 1 sản phẩm, các key ko còn theo thứ tự 0 - > length array*/
            {
                //echo($_SESSION['giohang_ID'][$i]."<br>");
                
                     $sqlstr="select ID,TenDoChoi,GiaBan,HinhAnh from dochoi where ID = ".$v;					 
                     $result=DataProvider::execQuery($sqlstr);                     
                     $row=mysql_fetch_array($result);
                     ?>
                     
<div class ="item_detail_giohang" id="item_detail_giohang_<?php echo $row['ID']; ?>">                                            
                          <div class="anhsanpham_giohang"><img width="50px" src="img/<?php echo $row['HinhAnh']; ?>" /></div>        
                                              
                        	<!--THÔNG TIN SẢN PHẨM TRONG GIỎ HÀNG-->
  <div class="thongtinsanpham_giohang"> 
                                 <h4><?php echo $row['TenDoChoi']; ?></h4>
                                <span class="nhat"> giá bán: </span><span class="tien_items"><?php echo number_format($row['GiaBan'],0,',',' '); ?> </span>vnđ 
                                	
  </div>
                            <!--CÁC LỆNH CHỨC NĂNG TRONG GIỎ HÀNG-->
                      <div class="chucnang_chonsoluong" style="float:left; width:150px">
                                 <span class="textSoLuong" id="textSoLuong<?php echo $k;?>">1</span>
                     <input type="submit" name="buttonPlus" id="buttonPlus" value="+" class="button3" onclick="ThayDoiSoLuong(textSoLuong<?php echo $k;?>,+1);"/>
                               	  <input type="submit" name="buttonexcept" id="buttonexcept" value="-" class="button3" onclick="ThayDoiSoLuong(textSoLuong<?php echo $k;?>,-1);"/>
  </div>
                                	
                               	
                             <div class="chucnang_giohang">
                                 
                                <ul>
                                	
                                     <a href="index.php?page=detail&MaSanPham=<?php echo $row['ID']; ?>"><li>chi tiết</li></a>
                                     <a class="xoamot" href="javascript:void(0);" onclick="xoa_mot_san_pham_trong_gio_hang(<?php echo $row['ID']; ?>);"> <li>xoá</li></a>
                                </ul>
                                
       </div>
                     </div>
                     <?php
            }
    }

?>
