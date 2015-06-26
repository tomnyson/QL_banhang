<?php
    //nếu mà người dùng bấm vào trang này thì tăng lượt xem của sản phẩm đang xem chi tiết    
     if(isset($_GET['MaSanPham']) && is_numeric($_GET['MaSanPham']))
     {
        DataProvider::Tang_Mot_Luot_Xem($_GET['MaSanPham']);
     }   
?>
  <!--THÊM SẢN PHẨM VÀO GIỎ HÀNG-->     
            
                 
            <div class="clear"></div>
            <?php
                if(isset($_GET['themvaogiohang']))
                {
                    if(in_array($_GET['themvaogiohang'],$_SESSION['giohang_ID'])==false) //nếu sản phẩm thêm ko tồn tại trong giỏ
                    {
                        $_SESSION['giohang_ID'][]=$_GET['themvaogiohang']; 	
                        					
                    }   
                 
                }
            ?>
            <!-------------------------------->
<?php

//
   
    $masanpham=$_GET['MaSanPham'];
    
    $sqlstr="select *
                        from dochoi,nhasanxuat,loaidochoi,xuatxu 
                        where 
                        dochoi.IDLoaiDoChoi = loaidochoi.ID AND /*LẤY TÊN LOẠI ĐỒ CHƠI*/
                        dochoi.IDNhaSanXuat = nhasanxuat.ID AND /*LẤY TÊN NHÀ SẢN XUẤT*/
                        dochoi.IDXuatXu=xuatxu.ID AND           /*LẤY TÊN QUỐC GIA XUẤT XỨ*/
                        dochoi.ID=$masanpham;              /*LẤY THÔNG TIN ĐỒ CHƠI ĐANG CHỌN*/
                 ";
    
    $result = DataProvider::execQuery($sqlstr);
    
  
  
    $san_pham =   DataProvider::Lay_Danh_Sach_Chi_Tiet_Bang_Truy_Van($result);
    echo("<div class='thongke_items'>DANH MỤC: <span style='text-decoration:underline'>".$san_pham[0]['loaidochoi.TenLoaiDoChoi']." </span> THÔNG TIN: Mã sản phẩm: <span class='button2none'>".$masanpham."</span></div>");
   
    ?>
   
        <div class="item_detail"> 
 
        
            
                <div class="anhsanpham">
                    <img  width="250px" src="img/<?php echo $san_pham[0]['dochoi.HinhAnh']; ?>"/>
                
                            
                    
                </div>
                        <div style="position: absolute; right:10px; top:10px;">
						   <?php //thêm được nếu nó chưa nằm trong giỏ hàng                           
                           if(!in_array($san_pham[0]['dochoi.ID'],$_SESSION['giohang_ID']))
                           {?>
                                  <a href="javascript:void(0);" id="button_da_them_<?php echo $san_pham[0]['dochoi.ID'];?>" onclick="them_vao_gio_hang(<?php echo($san_pham[$i]['dochoi.ID']); ?>);">                       
						      	<img class="btn1" src="skin/img/them-gio-hang.jpg" />
					       	   </a>
                          <?php }
						  else
						  {						  	
						  ?>
                          	<a class="button2"><img src="skin/img/cart.png" /> đã thêm</a>
                          <?php }?>                        
                         </div>
                <div class="thongtinsanpham">
                    <ul>
                        <h2><?php echo $san_pham[0]['dochoi.TenDoChoi']; ?></h2>
                        <li><span class="nhat">giá bán: </span><span class="tiente"><?php echo number_format($san_pham[0]['dochoi.GiaBan']); ?> </span>vnđ
                        <li><span class="nhat">lượt xem:</span> <?php echo $san_pham[0]['dochoi.SoLuotXem']; ?>
                        <li><span class="nhat">số lượng đã bán:</span> <?php echo $san_pham[0]['dochoi.SoLuongBan']; ?>                        
                        <li><span class="nhat">xuất xứ: </span><?php echo $san_pham[0]['xuatxu.TenQuocGia']; ?>
                        <li><span class="nhat">nhà sản xuất: </span><b class="button2none"><?php echo $san_pham[0]['nhasanxuat.TenNSX']; ?></b>                   
                        
                        <li><span class="nhat">loại đồ chơi: </span><b class="button2none"><?php echo $san_pham[0]['loaidochoi.TenLoaiDoChoi']; ?></b>               
                        <li> <span class="nhat">ngày tiếp nhận: </span> <?php echo date('d/m/Y',strtotime($san_pham[0]['dochoi.NgayTiepNhan'])); ?>
                        
                     </ul>
                </div>
                <div class="clear"></div>
                
                
                     <span class="nhat">mô tả: </span><div class="mota"><?php echo ($san_pham[0]['dochoi.MoTa']!='')?$san_pham[0]['dochoi.MoTa']:'<img src="skin/img/update.png">đang cập nhật'; ?></div>
                    
                     <div  style="width:800; float: left;">
                           <p class="nhat">thương hiệu: </p>
                           <div style="float: left; width:150px;margin-right:10px;">
                                    <img  width="150px" src="img/<?php echo $san_pham[0]['nhasanxuat.HinhAnh']; ?>"/>  
                            </div>    
                             <div class="mota2">
                                    <p class="nhat">thông tin: </p>
                                    <?php echo ($san_pham[0]['nhasanxuat.ThongTin']!='')?$san_pham[0]['nhasanxuat.ThongTin']:'<img src="skin/img/update.png"> đang cập nhật'; ?>
                             </div>
                                               
                     </div>
              
         
             
        </div>
    <?php
    
    

?>
<div class="clear"></div>
<div class="title">những sản phẩm liên quan</div>
<?php
	/*-----------CÙNG HÃNG SÀN XUẤT---------------*/
	$mahangsanxuat_lienquan = $san_pham[0]['nhasanxuat.ID'];	
	$maloaisanpham_lienquan=$san_pham[0]['loaidochoi.ID'];
	if(isset($mahangsanxuat_lienquan))
    {
        $nhasanxuat=$mahangsanxuat_lienquan;
        require_once("DataProvider.php");
        $sqlstr="select *
                        from dochoi,nhasanxuat,loaidochoi,xuatxu 
                        where 
                        dochoi.IDLoaiDoChoi = loaidochoi.ID AND /*LẤY TÊN LOẠI ĐỒ CHƠI*/
                        dochoi.IDNhaSanXuat = nhasanxuat.ID AND /*LẤY TÊN NHÀ SẢN XUẤT*/
                        dochoi.IDXuatXu=xuatxu.ID AND           /*LẤY TÊN QUỐC GIA XUẤT XỨ*/
                        nhasanxuat.ID=$nhasanxuat LIMIT 5;              /*LOAD TẤT CẢ ĐỒ CHƠI CÙNG NHÀ SẢN XUẤT ĐANG CHỌN*/
                 ";
        $result=DataProvider::execQuery($sqlstr);               
        $tong_san_pham=mysql_num_rows($result);
        if($tong_san_pham>0)
        {
                    echo '<div class="thongke_items">có ('.$tong_san_pham.') sản phẩm cùng hãng</div>';
                      
                   
                    $san_pham=DataProvider::Lay_Danh_Sach_Chi_Tiet_Bang_Truy_Van($result); 
                           
                    for($i=0;$i<$tong_san_pham;$i++)
                    {
                   ?>  
                           <div class="items" >
                            <div class="items_hinhanh">
                            <?php echo "ma san pham: ".$san_pham[$i]['dochoi.ID'];?> <br />
                            <span class="button2none"><?php echo $san_pham[$i]['nhasanxuat.TenNSX'];?></span> <br />
                            <img width="150px" src="img/<?php echo $san_pham[$i]['dochoi.HinhAnh']; ?>" />
                            <br /><b><?php echo $san_pham[$i]['dochoi.TenDoChoi']; ?></b>
                            </div>
                            
                            <div class="items_thongtin">
                            
                            <br /><span class="tiente"><?php echo number_format($san_pham[$i]['dochoi.GiaBan']); ?> </span> vnđ   
                                        
                            <br /><a href="index.php?page=detail&amp;MaSanPham=<?php echo $san_pham[$i]['dochoi.ID']; ?>"><img class="btn1" src="skin/img/chi-tiet.gif" /></a>   	<br />         
                          
                    
                     <!--THÊM SẢN PHẨM VÀO GIỎ HÀNG-->       
                 
                 
                             <?php //thêm được nếu nó chưa nằm trong giỏ hàng				   
        					   if(in_array($san_pham[$i]['dochoi.ID'],$_SESSION['giohang_ID']))
        					   {?><a class="button2"><img src="skin/img/cart.png" /> đã thêm</a>	
                             <?php }
        						  else
        						  {						  	
        						  ?>                          
                          
                          	  <a href="index.php?page=show&amp;HangSanXuat=<?php echo $san_pham[$i]['dochoi.IDNhaSanXuat']."&themvaogiohang=".$san_pham[$i]['dochoi.ID']; ?>">                       
						      	<img class="btn1" src="skin/img/them-gio-hang.jpg" />
					       	   </a>
                          <?php }?>
                    
                    <?php
                        if(isset($_GET['themvaogiohang']))
                        {
                            if(in_array($_GET['themvaogiohang'],$_SESSION['giohang_ID'])==false) //nếu sản phẩm thêm ko tồn tại trong giỏ
                            {                              
                                $_SESSION['giohang_ID'][]=$_GET['themvaogiohang'];                      
                              	header("location:index.php?page=show&HangSanXuat=".$san_pham[$i]['dochoi.IDNhaSanXuat']);
                            }                           
                        }
                    ?>
                    <!-------------------------------->                                                      
                            
                        </div>
                    </div> <!---END DIV CLASS = items_thongtin--->
                    
                    
                   
                    
                   <?php
                    }
        }else{
             echo '<div class="thongke_items">HIỆN CHÚNG TÔI CHƯA NHẬP SẢN PHẨM TỪ CÔNG TY NÀY</div>';
        }
	}
	?>
    <div class="clear"></div>
    <?php
	/*-----------------CÙNG LOẠI ĐỒ CHƠI-------------*/
	if(isset($mahangsanxuat_lienquan))
    {
        $loaidochoi=$maloaisanpham_lienquan;
        require_once("DataProvider.php");
        $sqlstr="select *
                        from dochoi,nhasanxuat,loaidochoi,xuatxu 
                        where 
                        dochoi.IDLoaiDoChoi = loaidochoi.ID AND /*LẤY TÊN LOẠI ĐỒ CHƠI*/
                        dochoi.IDNhaSanXuat = nhasanxuat.ID AND /*LẤY TÊN NHÀ SẢN XUẤT*/
                        dochoi.IDXuatXu=xuatxu.ID AND           /*LẤY TÊN QUỐC GIA XUẤT XỨ*/
                        loaidochoi.ID=$loaidochoi LIMIT 5;              /*LOAD TẤT CẢ ĐỒ CHƠI CÙNG LOẠI*/
                 ";
        $result=DataProvider::execQuery($sqlstr);               
        $tong_san_pham=mysql_num_rows($result);
        if($tong_san_pham>0)
        {
                    echo '<div class="thongke_items">có ('.$tong_san_pham.') sản phẩm cùng loại</div>';
                      
                   
                    $san_pham=DataProvider::Lay_Danh_Sach_Chi_Tiet_Bang_Truy_Van($result); 
                           
                    for($i=0;$i<$tong_san_pham;$i++)
                    {
                   ?>  
                           <div class="items" style="min-height:370px;">
                            <div class="items_hinhanh">
                            <?php echo "ma san pham: ".$san_pham[$i]['dochoi.ID'];?> <br />
                            <span class="button2none"><?php echo $san_pham[$i]['loaidochoi.TenLoaiDoChoi'];?></span> <br />
                            <img width="155px" src="img/<?php echo $san_pham[$i]['dochoi.HinhAnh']; ?>" />
                            <br /><b><?php echo $san_pham[$i]['dochoi.TenDoChoi']; ?></b>
                            </div>
                            
                            <div class="items_thongtin">
                            
                            <br /><span class="tiente"><?php echo number_format($san_pham[$i]['dochoi.GiaBan']); ?> </span> vnđ   
                                        
                            <br /><a href="index.php?page=detail&amp;MaSanPham=<?php echo $san_pham[$i]['dochoi.ID']; ?>"><img class="btn1" src="skin/img/chi-tiet.gif" /></a>   	<br />         
                          
                    
                     <!--THÊM SẢN PHẨM VÀO GIỎ HÀNG-->       
                 
                 
                             <?php //thêm được nếu nó chưa nằm trong giỏ hàng				   
        					   if(in_array($san_pham[$i]['dochoi.ID'],$_SESSION['giohang_ID']))
        					   {?><a class="button2"><img src="skin/img/cart.png" /> đã thêm</a>	
                             <?php }
        						  else
        						  {						  	
        						  ?>                          
                          
                          	  <a href="index.php?page=show&amp;HangSanXuat=<?php echo $san_pham[$i]['dochoi.IDNhaSanXuat']."&themvaogiohang=".$san_pham[$i]['dochoi.ID']; ?>">                       
						      	<img class="btn1" src="skin/img/them-gio-hang.jpg" />
					       	   </a>
                          <?php }?>
                    
                    <?php
                        if(isset($_GET['themvaogiohang']))
                        {
                            if(in_array($_GET['themvaogiohang'],$_SESSION['giohang_ID'])==false) //nếu sản phẩm thêm ko tồn tại trong giỏ
                            {                              
                                $_SESSION['giohang_ID'][]=$_GET['themvaogiohang'];                      
                              	header("location:index.php?page=show&HangSanXuat=".$san_pham[$i]['dochoi.IDNhaSanXuat']);
                            }                           
                        }
                    ?>
                    <!-------------------------------->                                                       
                           
                        </div>
                    </div> <!---END DIV CLASS = items_thongtin--->
                    
                    
                   
                    
                   <?php
                    }
        }else{
             echo '<div class="thongke_items">HIỆN CHÚNG TÔI CHƯA NHẬP SẢN PHẨM TỪ CÔNG TY NÀY</div>';
        }
	}
	
	
	
	
?>