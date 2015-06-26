	<p class="title">sản phẩm mới <img src="skin/img/new2.png" width="25px"/></p>	

    <?php	

        $sqlstr="select *
                        from dochoi,nhasanxuat,loaidochoi,xuatxu 
                        where 
                        dochoi.IDLoaiDoChoi = loaidochoi.ID AND 
                        dochoi.IDNhaSanXuat = nhasanxuat.ID AND 
                        dochoi.IDXuatXu=xuatxu.ID order by dochoi.NgayTiepNhan DESC LIMIT 10; 
                 ";
        $result=DataProvider::execQuery($sqlstr);               
        $tong_san_pham=mysql_num_rows($result);
         if($tong_san_pham>0)
        {
                    echo '<div class="thongke_items">('.$tong_san_pham.') sản phẩm</div>';
                      
                   
                    $san_pham=DataProvider::Lay_Danh_Sach_Chi_Tiet_Bang_Truy_Van($result); 
                           
                    for($i=0;$i<$tong_san_pham;$i++)
                    {
                           ?>  
                                   <div class="items">
                                    <div class="items_hinhanh">
                                    <?php echo "mã sp: <span class='button2none'>".$san_pham[$i]['dochoi.ID'];?></span> <br />
                                    <img width="160px" src="img/<?php echo $san_pham[$i]['dochoi.HinhAnh']; ?>" />
                                    <br /><b><?php echo $san_pham[$i]['dochoi.TenDoChoi']; ?> <img src="skin/img/neww.gif" /></b>
                                    </div>
                                    
                                    <div class="items_thongtin">
                                    
                                    <br /><span class="tiente"><?php echo number_format($san_pham[$i]['dochoi.GiaBan']); ?> </span> vnđ   
                                                
                                    <br /><a href="index.php?page=detail&MaSanPham=<?php echo $san_pham[$i]['dochoi.ID']; ?>"><img class="btn1" src="skin/img/chi-tiet.gif" /></a>            
                               
                            
                             <!--THÊM SẢN PHẨM VÀO GIỎ HÀNG-->       
                         <br />
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
                              	header("location:index.php");
                            }                           
                        }
                    ?>
                            <!-------------------------------->                                                       
                                   
                                </div>
                            </div> <!---END DIV CLASS = items_thongtin--->
                           <?php
                    }
        }
        ?>

    
     <!-- ----------------------------------------------------------------------------------------->
    <div class="clear"></div>
    
    <p class="title">sản phẩm bán chạy nhất <img src="skin/img/money.png"  width="25px"/></p>	

    <?php	

        $sqlstr="select *
                        from dochoi,nhasanxuat,loaidochoi,xuatxu 
                        where 
                        dochoi.IDLoaiDoChoi = loaidochoi.ID AND 
                        dochoi.IDNhaSanXuat = nhasanxuat.ID AND 
                        dochoi.IDXuatXu=xuatxu.ID order by dochoi.SoLuongBan DESC LIMIT 10; 
                 ";
        $result=DataProvider::execQuery($sqlstr);               
        if($tong_san_pham>0)
        {
                    echo '<div class="thongke_items">('.$tong_san_pham.') sản phẩm</div>';
                      
                   
                    $san_pham=DataProvider::Lay_Danh_Sach_Chi_Tiet_Bang_Truy_Van($result); 
                           
                    for($i=0;$i<$tong_san_pham;$i++)
                    {
                           ?>  
                                   <div class="items" style="min-height:350px;">
                                    <div class="items_hinhanh">
                                    <?php echo "mã sp: <span class='button2none'>".$san_pham[$i]['dochoi.ID'];?></span><br />
                                     <?php echo "đã bán: <span class='button2none'>".$san_pham[$i]['dochoi.SoLuongBan'];?> cái </span><br />
                                    <img width="150px" src="img/<?php echo $san_pham[$i]['dochoi.HinhAnh']; ?>" />
                                    <br /><b><?php echo $san_pham[$i]['dochoi.TenDoChoi']; ?></b>
                                    </div>
                                    
                                    <div class="items_thongtin">
                                    
                                    <br /><span class="tiente"><?php echo number_format($san_pham[$i]['dochoi.GiaBan']); ?> </span> vnđ   
                                                
                                    <br /><a href="index.php?page=detail&MaSanPham=<?php echo $san_pham[$i]['dochoi.ID']; ?>"><img class="btn1" src="skin/img/chi-tiet.gif" /></a>            
                                  
                            
                             <!--THÊM SẢN PHẨM VÀO GIỎ HÀNG-->       
                         <br />  
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
                              		header("location:index.php");
                            }                           
                        }
                    ?>
                            <!-------------------------------->                                                       
                               
                                </div>
                            </div> <!---END DIV CLASS = items_thongtin--->
                           <?php
                    }
        }
        ?>

   