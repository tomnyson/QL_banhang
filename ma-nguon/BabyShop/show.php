<?php

//----------------------------------LOẠI ĐỒ CHƠI--------------------------------
    if(isset($_GET['LoaiDoChoi']))
    {
        $loaidochoi=$_GET['LoaiDoChoi'];      
        $sqlstr="select *
                        from dochoi,nhasanxuat,loaidochoi,xuatxu 
                        where 
                        dochoi.IDLoaiDoChoi = loaidochoi.ID AND /*LẤY TÊN LOẠI ĐỒ CHƠI*/
                        dochoi.IDNhaSanXuat = nhasanxuat.ID AND /*LẤY TÊN NHÀ SẢN XUẤT*/
                        dochoi.IDXuatXu=xuatxu.ID AND           /*LẤY TÊN QUỐC GIA XUẤT XỨ*/
                        loaidochoi.ID=$loaidochoi;              /*LOAD TẤT CẢ ĐỒ CHƠI LẤY THÔNG TIN CỦA LOẠI ĐỒ CHƠI ĐANG CHỌN*/
                 ";
        $result=DataProvider::execQuery($sqlstr);               
        $tong_san_pham=mysql_num_rows($result);
        if($tong_san_pham>0)
        {
                    $san_pham=DataProvider::Lay_Danh_Sach_Chi_Tiet_Bang_Truy_Van($result); 
                    echo '<div class="thongke_items">DANH MỤC THỂ LOẠI ĐỒ CHƠI: <span class="button2none">'.$san_pham[0]['loaidochoi.TenLoaiDoChoi'].'</span> - có tất cả: ('.$tong_san_pham.') sản phẩm</div>';
                      
                    for($i=0;$i<$tong_san_pham;$i++)
                    {
                   ?>  
                       
                       <div class="items">
                            <div class="items_hinhanh">
                            <?php echo "mã SP:  <span class='button2none'>".$san_pham[$i]['dochoi.ID'];?></span><br />
                            <img width="150px" src="img/<?php echo $san_pham[$i]['dochoi.HinhAnh']; ?>" />
                            <br /><b><?php echo $san_pham[$i]['dochoi.TenDoChoi']; ?></b>
                            </div>
                            
                            <div class="items_thongtin">
                            
                            <br /><span class="tiente"><?php echo number_format($san_pham[$i]['dochoi.GiaBan']); ?> </span> vnđ   
                                        
                            <br /><a href="index.php?page=detail&amp;MaSanPham=<?php echo $san_pham[$i]['dochoi.ID']; ?>"><img class="btn1" src="skin/img/chi-tiet.gif" /></a>            
                          
                    
                     <!--THÊM SẢN PHẨM VÀO GIỎ HÀNG-->     
                   <br />
                   <?php //thêm được nếu nó chưa nằm trong giỏ hàng
				   
				   if(in_array($san_pham[$i]['dochoi.ID'],$_SESSION['giohang_ID']))
				   {?>
                   	<a class="button2none"><img src="skin/img/cart.png" /> đã thêm</a>
                    
                     <?php }
						  else
						  {						  	
						  ?>
                          		 <a href="javascript:void(0);" id="button_da_them_<?php echo $san_pham[$i]['dochoi.ID'];?>" onclick="them_vao_gio_hang(<?php echo($san_pham[$i]['dochoi.ID']); ?>);">                       
						      	<img class="btn1" src="skin/img/them-gio-hang.jpg" />
					       	   </a> 
                          <?php }?>
                    
                    <?php
                        if(isset($_GET['themvaogiohang']))
                        {
                            if(in_array($_GET['themvaogiohang'],$_SESSION['giohang_ID'])==false) //nếu sản phẩm thêm ko tồn tại trong giỏ
                            {                              
                                $_SESSION['giohang_ID'][]=$_GET['themvaogiohang'];                      
                              	header("location:index.php?page=show&LoaiDoChoi=".$san_pham[$i]['dochoi.IDLoaiDoChoi']);
                            }                          
                        }
                    ?>
                    <!-------------------------------->
                                                        
                           
                        </div>
                        </div>
                   <?php
                    }
        }else{
            echo '<div class="thongke_items">HIỆN CHƯA CÓ SẢN PHẨM NÀO CHO MỤC NÀY</div>';
            
        }
    }
//-----------------------------------NHÀ/HÃNG SẢN XUẤT--------------------------------
    if(isset($_GET['HangSanXuat']))
    {
        $nhasanxuat=$_GET['HangSanXuat'];
        require_once("DataProvider.php");
        $sqlstr="select *
                        from dochoi,nhasanxuat,loaidochoi,xuatxu 
                        where 
                        dochoi.IDLoaiDoChoi = loaidochoi.ID AND /*LẤY TÊN LOẠI ĐỒ CHƠI*/
                        dochoi.IDNhaSanXuat = nhasanxuat.ID AND /*LẤY TÊN NHÀ SẢN XUẤT*/
                        dochoi.IDXuatXu=xuatxu.ID AND           /*LẤY TÊN QUỐC GIA XUẤT XỨ*/
                        nhasanxuat.ID=$nhasanxuat;              /*LOAD TẤT CẢ ĐỒ CHƠI CÙNG NHÀ SẢN XUẤT ĐANG CHỌN*/
                 ";
        $result=DataProvider::execQuery($sqlstr);               
        $tong_san_pham=mysql_num_rows($result);
        if($tong_san_pham>0)
        {
                   
                      
                   
                    $san_pham=DataProvider::Lay_Danh_Sach_Chi_Tiet_Bang_Truy_Van($result); 
                    echo '<div class="thongke_items">DANH MỤC HÃNG ĐỒ CHƠI: <span class="button2none">'.$san_pham[0]['nhasanxuat.TenNSX'].'</span> - có tất cả: ('.$tong_san_pham.') sản phẩm</div>';       
                    for($i=0;$i<$tong_san_pham;$i++)
                    {
                   ?>  
                           <div class="items">
                            <div class="items_hinhanh">
                            <?php echo "mã SP:  <span class='button2none'>".$san_pham[$i]['dochoi.ID'];?></span> <br />
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
                          
                          	  	 <a href="javascript:void(0);" id="button_da_them_<?php echo $san_pham[$i]['dochoi.ID'];?>" onclick="them_vao_gio_hang(<?php echo($san_pham[$i]['dochoi.ID']); ?>);">                       
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
        
          $sqlstr="select * from nhasanxuat where ID = $nhasanxuat";
        $result = DataProvider::execQuery($sqlstr);
        $san_pham =   DataProvider::Lay_Danh_Sach_Chi_Tiet_Bang_Truy_Van($result);
        
        ?> 
        <div class="clear"></div>    
        
         <!---THÔNG TIN THƯƠNG HIỆU-->                   
                    <hr />
                     <div  style="width:800; margin:25px auto; auto;">
                           <p class="nhat">thương hiệu: </p>
                           
                           <div style="float: left; width:150px;margin-right:10px;">
                                    <img  width="150px" src="img/<?php echo $san_pham[0]['nhasanxuat.HinhAnh']; ?>"/>  
                            </div>    
                             <div class="mota2">
                                    <p class="nhat">thông tin: </p>
                                    <?php echo ($san_pham[0]['nhasanxuat.ThongTin']!='')?$san_pham[0]['nhasanxuat.ThongTin']:'<img src="skin/img/update.png"> đang cập nhật'; ?>
                             </div>
                                               
                     </div>
       <!-------->
        
        <?php
        
    }
 
?>