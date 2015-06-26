<link  rel="stylesheet" type="text/css" href="skin/css/timkiem.css"/>
<script>
  $(document).ready(function(){  
                 
                     $(".close_items_search").click(function(){
                        $(this).parent().fadeOut();
                      });
                                          
                });
                
</script> 

<?php
   // món+1&selectGiaTu=0&selectGiaDen=3000000&selectLoaiDoChoi=18&selectNhaSanXuat=57 
    if(isset($_GET['buttonTimKiem']) && $_GET['buttonTimKiem'] == 'go' 
                                    && isset($_GET['selectGiaTu'])
                                    && isset($_GET['selectGiaDen'])
                                    && isset($_GET['selectLoaiDoChoi'])
                                    && isset($_GET['selectNhaSanXuat'])
                                    && isset($_GET['textTimKiem'])
                                    )
    {
        $demketquatimduoc=0;
        
            $textTimKiem=$_GET['textTimKiem'];
            
            $selectGiaTu=$_GET['selectGiaTu'];
            $selectGiaDen=$_GET['selectGiaDen'];
            $selectLoaiDoChoi=$_GET['selectLoaiDoChoi'];
            $selectNhaSanXuat=$_GET['selectNhaSanXuat'];
            
            $buttonTimKiem=$_GET['buttonTimKiem'];
            
             $mang_sqlstr_sanpham =array(); //mảng này chứa các câu truy vấn
            
             //-------------------------tìm kiếm thường---------------------------------
             if($selectGiaTu=='-1' && $selectGiaDen == '-1' && $selectLoaiDoChoi == '-1' && $selectNhaSanXuat =='-1')
             {
			 		
			 		echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ: <span class='button2none'>$textTimKiem</span></p>");
					  echo("<div class='title'>sản phẩm</div>");
					  /*SẢN PHẨM*/
					 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem';"; //bắt đầu bằng từ tìm kiếm
					 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%';"; //kết thúc bằng từ tìm kiếm
					 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%';"; //chứa từ tìm kiếm
					 
					 for($i=0; $i<count($mang_sqlstr_sanpham);$i++)
					 {
						$result=DataProvider::execQuery($mang_sqlstr_sanpham[$i]);
						
						while($row=mysql_fetch_array($result))
						{$demketquatimduoc++;
								$thaythe="<b style='color:red;background:yellow;'>$textTimKiem</b";
							?>
							
							
							<div class="items_search">
									<div style="float:left; width:51px;">         
									<img width="50px" src="img/<?php echo $row[2]; ?>"/>  
									</div>  
									<a href="index.php?page=detail&MaSanPham=<?php  echo $row[0];?>">
											<div style="float: left; width=350px;">  
                                            
                                            <!--TÊN ĐỒ CHƠI--> 
                                                  
											<?php
											//tô đậm chữ sản phẩm tìm được
											$str = str_replace(strtoupper($textTimKiem),"<span style='background:yellow;'>".$textTimKiem."</span>",$row[1]);
											$str = str_replace(strtolower($textTimKiem),"<span style='background:yellow;'>".$textTimKiem."</span>",$row[1]);
											 echo $str; 
											 
											 ?><br />
                                            </a>
                                            <!--GIÁ BÁN-->
                                           <span class="tiente"><?php echo number_format($row['GiaBan'])."</span> vnđ"; ?><br />
                                           
                                            <!--LOẠI ĐỒ CHƠI-->
                                            <br />
                                            <?php $TenLoaiDoChoi = DataProvider::Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($row['IDLoaiDoChoi']); ?>										
                                            loại đồ chơi (<?php  echo $TenLoaiDoChoi; ?>)
                                             
                                             <!--HÃNG SẢN XUẤT-->                                        
                                            <Br /><?php $TenNSX = DataProvider::Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($row['IDNhaSanXuat']); ?>														
                                         <span> hãng (<?php  echo $TenNSX; ?>)</span>
                                            
											</div> 
									    
									<img class="close_items_search" src="skin/img/xclose.png" style="position:absolute;right: 0px;"/>
								 <div class="clear"></div>   
							</div>
							<?php       
						}
						echo("<div class='clear'></div>");
					 }
			}
				
             else{
/*-------------------------------------------------------------TÌM KIẾM NÂNG CAO------------------------------------------------------*/
				/*CHỌN GIÁ NHƯNG KHÔNG CHỌN LOẠI ĐỒ CHƠI HOẶC NHÀ SẢN XUẤT*/				             
				 if((($selectGiaTu=='-1' && $selectGiaDen != '-1') //nếu không chọn giá từ mà chọn giá đến
				 	|| ($selectGiaTu!='-1' || $selectGiaDen == '-1') //HOẶC nếu không chọn giá từ mà không chọn giá đến
					||($selectGiaTu!='-1' || $selectGiaDen != '-1'))  //HOẶC nếu chọn cả 2 -----> trường hợp ko chọn bỏ
								&&( $selectLoaiDoChoi == '-1' && $selectNhaSanXuat =='-1'))
				 {
					
                  
					 $_selectGiaTu=0; //cho nhỏ nhất MẶC ĐỊNH
					 $_selectGiaDen=3000000; //cho lớn nhất MẶC ĐỊNH
					 
					 	if(($selectGiaTu=='-1' && $selectGiaDen != '-1')){ //chỉ chọn mình giá đến
								$_selectGiaDen=$selectGiaDen;
								//thông báo 
									echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
					 		<Br />với mức nhỏ hơn <span class='tiente'>".number_format($_selectGiaDen)."
					 </span> vnđ</p>");
                            
								
								
						}else if($selectGiaTu!='-1' && $selectGiaDen == '-1'){ // chỉ chọn mình giá từ
								$_selectGiaTu=$selectGiaTu;
								
									//thông báo 
									
									 echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
					 		<Br />với mức giá từ: <span class='tiente'>".number_format($_selectGiaTu)."</span> vnđ Trờ lên");
						}else{ //chọn cả hai 
							$_selectGiaTu=$selectGiaTu;
							$_selectGiaDen=$selectGiaDen;	
							
							//thông báo							
							 echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
					 		<Br />với mức giá từ: <span class='tiente'>".number_format($_selectGiaTu)."</span> vnđ -  đến <span class='tiente'>".number_format($_selectGiaDen)."
					 </span> vnđ</p>");						
						}
				
						  echo("<div class='title'>sản phẩm</div>");
						 
						 
						  /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen"; //bắt đầu bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen"; //kết thúc bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen"; //chứa từ tìm kiếm
						
                         
                         /*XUẤT RA TẤT CẢ CÁC DÒNG ĐÃ TRUY VẤN THẤY*/
                         
						 for($i=0; $i<count($mang_sqlstr_sanpham);$i++)
						 {
							$result=DataProvider::execQuery($mang_sqlstr_sanpham[$i]);
							
							while($row=mysql_fetch_array($result))
							{$demketquatimduoc++;
									$thaythe="<b style='color:red;background:yellow;'>$textTimKiem</b";
								?>
								
								
								<div class="items_search">
									<div style="float:left; width:51px;">         
									<img width="50px" src="img/<?php echo $row[2]; ?>"/>  
									</div>  
									<a href="index.php?page=detail&MaSanPham=<?php  echo $row[0];?>">
											<div style="float: left; width=350px;">         
											 <!--TÊN ĐỒ CHƠI--> 
                                                  
											<?php
											//tô đậm chữ sản phẩm tìm được
											$str = str_replace(strtoupper($textTimKiem),"<span style='background:yellow;'>".$textTimKiem."</span>",$row[1]);
											$str = str_replace(strtolower($textTimKiem),"<span style='background:yellow;'>".$textTimKiem."</span>",$row[1]);
											 echo $str; 
											 
											 ?><br />
                                             </a>
                                            <!--GIÁ BÁN-->
                                           <span class="tiente"><?php echo number_format($row['GiaBan'])."</span> vnđ"; ?><br />
                                           
                                            <!--LOẠI ĐỒ CHƠI-->
                                            <br />
                                            <?php $TenLoaiDoChoi = DataProvider::Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($row['IDLoaiDoChoi']); ?>										
                                            loại đồ chơi (<?php  echo $TenLoaiDoChoi; ?>)
                                             
                                             <!--HÃNG SẢN XUẤT-->                                        
                                            <Br /><?php $TenNSX = DataProvider::Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($row['IDNhaSanXuat']); ?>														
                                         <span> hãng (<?php  echo $TenNSX; ?>)</span>
                                            
                                            
											</div> 
									   
									<img class="close_items_search" src="skin/img/xclose.png" style="position:absolute;right: 0px;"/>
								 <div class="clear"></div>   
							</div>
								<?php       
							}
							echo("<div class='clear'></div>");
						 }
				}
                else/*kết thúc phần tìm có giá từ đến, nhưng không nhập loại đồ chơi và tên công ty*/
                /*ĐẾN LƯỢT CHỈ CHỌN NHÀ SẢN XUẤT/ HÃNG SẢN XUẤT MÀ KHÔNG CHỌN GIÁ*/
                 if(($selectGiaTu=='-1' && $selectGiaDen == '-1')) //không chọn giá và chọn hãng sản xuất hoặc loại sản phẩm
				 {
				        if($selectLoaiDoChoi!=-1 && $selectNhaSanXuat =='-1') //chỉ chọn loại đồ chơi
                        {
                                
                                //thông báo
                                echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
					 		<Br />và thuộc loại đồ chơi: <span class='button2none'>".DataProvider::Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($selectLoaiDoChoi)."</span></p>");
                            
                            
                              /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND IDLoaiDoChoi = $selectLoaiDoChoi";
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND IDLoaiDoChoi = $selectLoaiDoChoi";
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND IDLoaiDoChoi = $selectLoaiDoChoi";
                            
                        }
                        else if($selectLoaiDoChoi=='-1' && $selectNhaSanXuat !='-1')//chỉ chọn nhà sản xuất
                        {                            
                            //thông báo
                                echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
					 		<Br />và có nhãn hiệu: <span class='button2none'>".DataProvider::Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($selectNhaSanXuat)."</span></p>");
                            
                              /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND IDNhaSanXuat = $selectNhaSanXuat";
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND IDNhaSanXuat = $selectNhaSanXuat";
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND IDNhaSanXuat = $selectNhaSanXuat";
                            
                        }else{//chọn cả hai
                            
                            //thông báo
                                echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
					 		<Br />thuộc loại đồ chơi: <span class='button2none'>".DataProvider::Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($selectLoaiDoChoi)."</span>
                            <Br />và có nhãn hiệu: <span class='button2none'>".DataProvider::Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($selectNhaSanXuat)."</span></p>");
                                
                                
                                  /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND IDNhaSanXuat = $selectNhaSanXuat AND IDLoaiDoChoi = $selectLoaiDoChoi";
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND IDNhaSanXuat = $selectNhaSanXuat AND IDLoaiDoChoi = $selectLoaiDoChoi";
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND IDNhaSanXuat = $selectNhaSanXuat AND IDLoaiDoChoi = $selectLoaiDoChoi";
                        }   
                        for($i=0; $i<count($mang_sqlstr_sanpham);$i++)
						 {
							$result=DataProvider::execQuery($mang_sqlstr_sanpham[$i]);
							
							while($row=mysql_fetch_array($result))
							{$demketquatimduoc++;
									$thaythe="<b style='color:red;background:yellow;'>$textTimKiem</b";
								?>
								
								
								<div class="items_search">
									<div style="float:left; width:51px;">         
									<img width="50px" src="img/<?php echo $row[2]; ?>"/>  
									</div>  
									<a href="index.php?page=detail&MaSanPham=<?php  echo $row[0];?>">
											<div style="float: left; width=350px;">         
											 <!--TÊN ĐỒ CHƠI--> 
                                                  
											<?php
											//tô đậm chữ sản phẩm tìm được
											$str = str_replace(strtoupper($textTimKiem),"<span style='background:yellow;'>".$textTimKiem."</span>",$row[1]);
											$str = str_replace(strtolower($textTimKiem),"<span style='background:yellow;'>".$textTimKiem."</span>",$row[1]);
											 echo $str; 
											 
											 ?><br />
                                             </a> 
                                            <!--GIÁ BÁN-->
                                           <span class="tiente"><?php echo number_format($row['GiaBan'])."</span> vnđ"; ?><br />
                                           
                                            <!--LOẠI ĐỒ CHƠI-->
                                            <br />
                                            <?php $TenLoaiDoChoi = DataProvider::Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($row['IDLoaiDoChoi']); ?>										
                                            loại đồ chơi (<?php  echo $TenLoaiDoChoi; ?>)
                                             
                                             <!--HÃNG SẢN XUẤT-->                                        
                                            <Br /><?php $TenNSX = DataProvider::Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($row['IDNhaSanXuat']); ?>														
                                         <span> hãng (<?php  echo $TenNSX; ?>)</span>
                                            
                                            
											</div> 
									  
									<img class="close_items_search" src="skin/img/xclose.png" style="position:absolute;right: 0px;"/>
								 <div class="clear"></div>   
							</div>
								<?php       
							}
							echo("<div class='clear'></div>");
						 }
					 
						 		
                 }
                 /*ĐÂY LÀ TRƯỜNG HỢP CUỐI CÙNG, DÀI NHẤT -PHẦN NÂNG CAO ĐƯỢC NGƯỜI DÙNG CHỌN TẤT CẢ*/
                 else
                 {  
					 $_selectGiaTu=0; //cho nhỏ nhất MẶC ĐỊNH
					 $_selectGiaDen=3000000; //cho lớn nhất MẶC ĐỊNH
					 
					 	if(($selectGiaTu=='-1' && $selectGiaDen != '-1') ){ //chỉ chọn mình giá đến
								$_selectGiaDen=$selectGiaDen;
                                if($selectLoaiDoChoi!= -1 && $selectNhaSanXuat ==-1) //nếu chỉ chọn loại đồ chơi
                                {  
                                      	//thông báo 
								    	echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
            					 		<Br />với mức nhỏ hơn <span class='tiente'>".number_format($_selectGiaDen)."</span>
                                        <Br />và thuộc loại đồ chơi: <span class='button2none'>".DataProvider::Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($selectLoaiDoChoi)."</span></p>");
            					           
                                         /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectLoaiDoChoi"; //bắt đầu bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectLoaiDoChoi"; //kết thúc bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectLoaiDoChoi"; //chứa từ tìm kiếm   
                                           
                                    
                                }else if($selectLoaiDoChoi==-1 && $selectNhaSanXuat!=-1)//nếu chỉ chọn nhà sản xuất
                                {  
                                    //thông báo 
									
									 echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
					 		<Br />với mức nhỏ hơn <span class='tiente'>".number_format($_selectGiaDen)."</span> vnđ Trờ lên
                             	<Br />và có nhãn hiệu: <span class='button2none'>".DataProvider::Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($selectNhaSanXuat)."</span></p>");
                                    
                                     /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat"; //bắt đầu bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat"; //kết thúc bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat"; //chứa từ tìm kiếm   
                              
                              
                                }else{ //chọn cả LOẠI ĐỒ CHƠI VÀ NHÀ SẢN XUẤT                                
                                        
                                    //thông báo							
    							 echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
    					 		<Br />với mức nhỏ hơn <span class='tiente'>".number_format($_selectGiaDen)."</span> vnđ 
                         	<Br />thuộc loại đồ chơi: <span class='button2none'>".DataProvider::Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($selectLoaiDoChoi)."</span>
                            <Br />và có nhãn hiệu: <span class='button2none'>".DataProvider::Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($selectNhaSanXuat)."</span></p>");
                                
                                  /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat AND IDloaiDoChoi = $selectLoaiDoChoi"; //bắt đầu bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat AND IDloaiDoChoi = $selectLoaiDoChoi"; //kết thúc bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat AND IDloaiDoChoi = $selectLoaiDoChoi"; //chứa từ tìm kiếm   
                              
                                
                                }
                                
								
						 /*--------------------------------------*/      		
						}else if($selectGiaTu!='-1' && $selectGiaDen == '-1')// chỉ chọn mình giá từ
                        { 
								$_selectGiaTu=$selectGiaTu;								
						       if($selectLoaiDoChoi!= -1 && $selectNhaSanXuat ==-1) //nếu chỉ chọn loại đồ chơi
                                {
                                      	//thông báo 
									echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
            					 		<Br />với mức giá từ <span class='tiente'>".number_format($_selectGiaTu)."</span> vnđ trở lên
                                        <Br />và thuộc loại đồ chơi: <span class='button2none'>".DataProvider::Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($selectLoaiDoChoi)."</span></p>");
            					 
                                      /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectLoaiDoChoi"; //bắt đầu bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectLoaiDoChoi"; //kết thúc bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectLoaiDoChoi"; //chứa từ tìm kiếm                                  
                                    
                                }else if($selectLoaiDoChoi==-1 && $selectNhaSanXuat!=-1)//nếu chỉ chọn nhà sản xuất
                                { 
                                    //thông báo 
									
									 echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
					 		<Br />với mức giá từ <span class='tiente'>".number_format($_selectGiaTu)."</span> vnđ trở lên
                             	<Br />và có nhãn hiệu: <span class='button2none'>".DataProvider::Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($selectNhaSanXuat)."</span></p>");
                                
                                
                                  /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat"; //bắt đầu bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat"; //kết thúc bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat"; //chứa từ tìm kiếm       
                                }else{ //chọn cả LOẠI ĐỒ CHƠI VÀ NHÀ SẢN XUẤT                                
                                         echo("<script>alert('x6')</script>;");
                                    //thông báo							
    							 echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
    					 		<Br />với mức giá từ <span class='tiente'>".number_format($_selectGiaTu)."</span> vnđ trở lên
                         	<Br />thuộc loại đồ chơi: <span class='button2none'>".DataProvider::Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($selectLoaiDoChoi)."</span>
                            <Br />và có nhãn hiệu: <span class='button2none'>".DataProvider::Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($selectNhaSanXuat)."</span></p>");
                               
                                /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat AND IDloaiDoChoi = $selectLoaiDoChoi"; //bắt đầu bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat AND IDloaiDoChoi = $selectLoaiDoChoi"; //kết thúc bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat AND IDloaiDoChoi = $selectLoaiDoChoi"; //chứa từ tìm kiếm   
                               
                                }
                         /*--------------------------------------*/       
						}else{ //chọn cả hai GIÁ TỪ - GIÁ ĐẾN
							$_selectGiaTu=$selectGiaTu;
							$_selectGiaDen=$selectGiaDen;	
							 if($selectLoaiDoChoi!= -1 && $selectNhaSanXuat ==-1) //nếu chỉ chọn loại đồ chơi
                                { 
                                      	//thông báo 
									echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
            					 		<Br />với mức giá từ: <span class='tiente'>".number_format($_selectGiaTu)."</span> vnđ -  đến <span class='tiente'>".number_format($_selectGiaDen)."</span> vnđ
                                        <Br />và thuộc loại đồ chơi: <span class='button2none'>".DataProvider::Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($selectLoaiDoChoi)."</span></p>");
            					 
                                    
                                    
                                       /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectLoaiDoChoi"; //bắt đầu bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectLoaiDoChoi"; //kết thúc bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectLoaiDoChoi"; //chứa từ tìm kiếm   
                                }else if($selectLoaiDoChoi==-1 && $selectNhaSanXuat!=-1)//nếu chỉ chọn nhà sản xuất
                                {  
                                    //thông báo 
									
									 echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
					 		<Br />với mức giá từ: <span class='tiente'>".number_format($_selectGiaTu)."</span> vnđ -  đến <span class='tiente'>".number_format($_selectGiaDen)."</span> vnđ
                             	<Br />và có nhãn hiệu: <span class='button2none'>".DataProvider::Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($selectNhaSanXuat)."</span></p>");
                                    
                                    
                                      /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat"; //bắt đầu bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat"; //kết thúc bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat"; //chứa từ tìm kiếm   
                                }else{ //chọn cả LOẠI ĐỒ CHƠI VÀ NHÀ SẢN XUẤT                                
                                        
                                    //thông báo							
    							 echo("<p class='thongbao'>tìm kiếm tất cả sản phẩm có chứa từ khoá: <span class='button2none'>$textTimKiem</span>
    					 	<Br />với mức giá từ: <span class='tiente'>".number_format($_selectGiaTu)."</span> vnđ -  đến <span class='tiente'>".number_format($_selectGiaDen)."</span> vnđ
                         	<Br />thuộc loại đồ chơi: <span class='button2none'>".DataProvider::Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($selectLoaiDoChoi)."</span>
                            <Br />và có nhãn hiệu: <span class='button2none'>".DataProvider::Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($selectNhaSanXuat)."</span></p>");
                                
                                 /*truy xuất SẢN PHẨM*/
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat AND IDloaiDoChoi = $selectLoaiDoChoi"; //bắt đầu bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat AND IDloaiDoChoi = $selectLoaiDoChoi"; //kết thúc bằng từ tìm kiếm
						 $mang_sqlstr_sanpham[]="select ID,TenDoChoi,HinhAnh,GiaBan,IDNhaSanXuat,IDLoaiDoChoi from dochoi WHERE TenDoChoi LIKE '%$textTimKiem%' AND GiaBan>=$_selectGiaTu AND GiaBan <=$_selectGiaDen AND IDloaiDoChoi = $selectNhaSanXuat AND IDloaiDoChoi = $selectLoaiDoChoi"; //chứa từ tìm kiếm   
                                
                                }
						}
                         for($i=0; $i<count($mang_sqlstr_sanpham);$i++)
						 {
							$result=DataProvider::execQuery($mang_sqlstr_sanpham[$i]);
							
							while($row=mysql_fetch_array($result))
							{$demketquatimduoc++;
									$thaythe="<b style='color:red;background:yellow;'>$textTimKiem</b";
								?>
								
								
								<div class="items_search">
									<div style="float:left; width:51px;">         
									<img width="50px" src="img/<?php echo $row[2]; ?>"/>  
									</div>  
									<a href="index.php?page=detail&MaSanPham=<?php  echo $row[0];?>">
											<div style="float: left; width=350px;">         
											 <!--TÊN ĐỒ CHƠI--> 
                                                  
											<?php
											//tô đậm chữ sản phẩm tìm được
											$str = str_replace(strtoupper($textTimKiem),"<span style='background:yellow;'>".$textTimKiem."</span>",$row[1]);
											$str = str_replace(strtolower($textTimKiem),"<span style='background:yellow;'>".$textTimKiem."</span>",$row[1]);
											 echo $str; 
											 
											 ?><br />
                                             </a>   
                                            <!--GIÁ BÁN-->
                                           <span class="tiente"><?php echo number_format($row['GiaBan'])."</span> vnđ"; ?><br />
                                           
                                            <!--LOẠI ĐỒ CHƠI-->
                                            <br />
                                            <?php $TenLoaiDoChoi = DataProvider::Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($row['IDLoaiDoChoi']); ?>										
                                            loại đồ chơi (<?php  echo $TenLoaiDoChoi; ?>)
                                             
                                             <!--HÃNG SẢN XUẤT-->                                        
                                            <Br /><?php $TenNSX = DataProvider::Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($row['IDNhaSanXuat']); ?>														
                                         <span> hãng (<?php  echo $TenNSX; ?>)</span>
                                            
                                            
											</div> 
									
									<img class="close_items_search" src="skin/img/xclose.png" style="position:absolute;right: 0px;"/>
								 <div class="clear"></div>   
							</div>
								<?php       
							}
							echo("<div class='clear'></div>");
						 }
					 
                        
                        
                 }
                
               
                 
                
                
	}/*HẾT PHẦN NÂNG CAO*/
    
	   echo("<br/><br/><br/><span style='padding:20px; background:yellow;position:absolute; right:0px; top:0px;'>tìm được $demketquatimduoc kết quả</span>");
			
    }/*KẾT THÚC TÌM KIẾM*/      
    else
    {   
        echo("CÁCH TÌM KHÔNG ĐÚNG");
    }
    

   
    
    
    
?>
