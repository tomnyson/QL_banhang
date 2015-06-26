                    <div class="menu"> <!--MENU-->
                    
                            <p class ="title2">LOẠI ĐỒ CHƠI</p><!--TIÊU ĐỀ NỘI DUNG-->
                						<ul>	
                					       	<?php 
                                                $sqlstr="select ID,TenLoaiDoChoi from loaidochoi";
                                                                               
                                                $result=DataProvider::execQuery($sqlstr);
                                                while($row = mysql_fetch_array($result))
                                                {
                                                //lay ra số lượng sản phẩm trong loại đồ chơi đang xét
                                                        
                                                        $sqlstr2= "select IDLoaiDoChoi from dochoi where IDLoaiDoChoi=".$row['ID'];
                                                        $result2= DataProvider::execQuery($sqlstr2);
                                                        $SoLuongDoChoiTrongLoaiDoChoi=mysql_num_rows($result2);
                                                    
                                                     //bôi đỏ cái menu nào đang active
                                                        $iddangchon=(isset($_GET['LoaiDoChoi'])&&$_GET['LoaiDoChoi']==$row[0])?'active':'khongchon';
                                                     //xuất toàn bộ danh sách menu
                                                    	echo '<a title="danh sách các đồ chơi cùng thể loại" href="index.php?page=show&LoaiDoChoi='.$row[0].'"><li  class="'.$iddangchon.'">'.$row[1].' <code>('.$SoLuongDoChoiTrongLoaiDoChoi.')</code>'.'</li></a>';
                                                }
                                            ?>
                						</ul>	
					   </div>
                    
                    
        					 <div class="menu"> <!--MENU-->
                                    <p class ="title2">HÃNG SẢN XUẤT</p><!--TIÊU ĐỀ NỘI DUNG-->
                                    <div class="scrollbar" id="style-1"> <!--THANH TRƯỢT NẾU ĐẦY-->
                                        <div class="force-overflow"><!--NỘI DUNG-->
        						<ul>	
                                    <?php 
                                        $sqlstr="select ID,TenNSX from nhasanxuat";
                                       
                                        $result=DataProvider::execQuery($sqlstr);
                                        while($row = mysql_fetch_array($result))
                                        {     
                                            //lay ra số lượng sản phẩm trong loại đồ chơi đang xét
                                                
                                                $sqlstr2= "select IDNhaSanXuat from dochoi where IDNhaSanXuat=".$row['ID'];
                                                $result2= DataProvider::execQuery($sqlstr2);
                                                $SoLuongDoChoiTrongLoaiDoChoi=mysql_num_rows($result2);
                                            //bôi đỏ cái menu nào đang active
                                            $iddangchon=(isset($_GET['HangSanXuat'])&&$_GET['HangSanXuat']==$row[0])?'active':'khongchon';
                                      		//xuất toàn bộ danh sách menu
                                            echo '<a title="danh sách các đồ chơi cùng hãng sản xuất"  href="index.php?page=show&HangSanXuat='.$row[0].'"><li class="'.$iddangchon.'">'.$row[1].' <code>('.$SoLuongDoChoiTrongLoaiDoChoi.')</code>'.'</li></a>';
                                        }
                                    ?>
        						</ul>
        			               </div>
                					</div>
        					
            				</div>
                    
                            
                            <div class="menu" style="background: #E9F5A0; border-radius: 0px 0px 10px 10px;"> <!--MENU-->
                            <p class ="title2">thống kê</p><!--TIÊU ĐỀ NỘI DUNG-->
                           
                                <ul>
                                   <li>tổng lượt truy cập: <b class="button2"><?php echo DataProvider::Tra_Ve_Tong_Luot_Truy_cap();?> </b></li>	
                                   <li>đang online: <b class="button2"><?php echo DataProvider::So_Luot_Nguoi_Dang_Online();?> </b></li>
                                   <li>số thành viên: <b class="button2"><?php echo DataProvider::So_Luong_Thanh_Vien_Trong_CSDL();?> </b></li>
                                  
                                </ul>         
                                 <p style="margin-left:15px;"><img src="skin/img/map.png" /><a href="index.php?page=lienhe"><span class="button1">cửa hàng</span></p></a>                       
                                  <br />
                           
                            </div> 