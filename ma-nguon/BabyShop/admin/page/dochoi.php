  <?php 
  $tong_san_pham=DataProvider::So_Luong_Do_Choi_Trong_CSDL();  
  echo 'tất cả: ('.$tong_san_pham.') sản phẩm đồ chơi';           
   ?>
 <hr />
 <div style="wposition: relative; width:150px; padding:15px;  margin:0px auto;">
    	 <a href="administrator.php?page=dochoi&do=them"> <input class="chucnang" type="submit" name="buttonThemAnHien" id="buttonThemAnHien" value="thêm sản phẩm đồ chơi"/></a>
   	 
    </div>
<?php
	//thêm
	if(isset($_POST['buttonThem']))
	{
		
		$tendochoi=$_POST['textTenDoChoi'];
        //nếu file up không tồn tại thì gán cho nó một ảnh rỗng
		$hinhanh=($_POST['textHinhAnh']!='' && file_exists("../img/".$_POST['textHinhAnh']))?$_POST['textHinhAnh']:'do-choi/no-photo.jpg';       
        
		$mota=$_POST['textMoTa'];
		$giaban=$_POST['textGiaBan'];
		//$ngaytiepnhan=$_POST['textNgayTiepNhan'];
	
	
		$nhasanxuat=$_POST['selectNhaSanXuat'];
		$loaidochoi=$_POST['selectLoaiDoChoi'];
		$xuatxu=$_POST['selectXuatXu'];
		
		echo("</br>".$tendochoi);
		echo("</br>".$hinhanh);
		echo("</br>".$mota);
		echo("</br>".$giaban);
		//echo("</br>".$ngaytiepnhan);
		echo("</br>".$nhasanxuat);
		echo("</br>".$loaidochoi);
		echo("</br>".$xuatxu);
		
		$sqlstr="INSERT INTO dochoi(TenDoChoi,GiaBan,HinhAnh,NgayTiepNhan,MoTa,IDNhaSanXuat,IDLoaiDoChoi,IDXuatXu)
							 VALUES('$tendochoi',$giaban,'$hinhanh',NOW(),'$mota',$nhasanxuat,$loaidochoi,$xuatxu);";
        DataProvider::execQuery($sqlstr);
        header("location:".$_SERVER['REQUEST_URI']);
    			
	}
	//xoá
	
	if(isset($_GET['do']) && isset($_GET['id']))
	{
		if($_GET['do']=='xoa' && (is_numeric($_GET['id'])==true))
		{
				$duongdananhxoa = DataProvider::Xoa_Mot_San_Pham($_GET['id']);
               
               
                
                //XOÁ LUÔN FILE CỦA NÓ NẾU TỒN TẠI, KHÔNG XOÁ ẢNH MẶC ĐỊNH
                 $strql="select ID from dochoi where hinhanh = '$duongdananhxoa'";
                $result=DataProvider::execQuery($sqlstr);
                if(mysql_num_rows($result)==1) //NẾU CHỈ CÓ MÌNH NÓ CÓ ẢNH NÀY MỚI XOÁ, PHÒNG KHI SẢN PHẨM DÙNG CHUNG ẢNH THÌ KHÔNG XOÁ
                {
                    if(file_exists("../img/$duongdananhxoa") && $duongdananhxoa!='do-choi/no-photo.jpg') 
                    {
                        $del="../img/$duongdananhxoa";
                         unlink($del); //xoá nó
                    }
                }
                
				header("location:administrator.php?page=dochoi");
		}
	}
	//lấy biến sửa
	if(isset($_GET['do']) && isset($_GET['id']))
	{
		if($_GET['do']=='sua' && (is_numeric($_GET['id'])==true))
		{
				$flag=false; //cho biết có móc được dữ liệu từ sản phẩm đang chọn hay không
				
				$ID=$_GET['id'];
				$s_ID=0;
				$s_tendochoi="";
				$s_hinhanh="";
				$s_giaban=0;
				$s_nhasanxuat="";
				$s_loaidochoi=0;
				$s_xuatxu=0;
				$s_mota="";
				
					/*LẤY RA THÔNG TIN CỦA ĐỒ CHƠI ĐANG CẦN SỬA*/
					$sqlstr="select *
								from dochoi,nhasanxuat,loaidochoi,xuatxu 
								where 
								dochoi.IDLoaiDoChoi = loaidochoi.ID AND /*LẤY TÊN LOẠI ĐỒ CHƠI*/
								dochoi.IDNhaSanXuat = nhasanxuat.ID AND /*LẤY TÊN NHÀ SẢN XUẤT*/
								dochoi.IDXuatXu=xuatxu.ID AND         /*LẤY TÊN QUỐC GIA XUẤT XỨ*/
								dochoi.ID=$ID /*LẤY RA THÔNG TIN CỦA ĐỒ CHƠI ĐANG CẦN SỬA*/
						 ";
					
					$result=DataProvider::execQuery($sqlstr);
					$san_pham=DataProvider::Lay_Danh_Sach_Chi_Tiet_Bang_Truy_Van($result);
					if(count($san_pham)>0)
					{
						$s_ID=$ID;
						$s_tendochoi=$san_pham[0]['dochoi.TenDoChoi'];
						$s_hinhanh=$san_pham[0]['dochoi.HinhAnh'];
						$s_giaban=$san_pham[0]['dochoi.GiaBan'];
						$s_nhasanxuat=$san_pham[0]['dochoi.IDNhaSanXuat'];
						$s_loaidochoi=$san_pham[0]['dochoi.IDLoaiDoChoi'];
						$s_xuatxu=$san_pham[0]['dochoi.IDXuatXu'];
						$s_mota=$san_pham[0]['dochoi.MoTa'];
						
						$flag=true; //đã móc được
					}
				
			//header("location:administrator.php?page=dochoi");
		}
	}
	//sửa
	if(isset($_POST['buttonSua']))
	{	
		$s_ID=$_POST['textID'];
		$s_tendochoi=$_POST['textTenDoChoi'];
		$s_hinhanh=$_POST['textHinhAnh'];
		$s_giaban=$_POST['textGiaBan'];
		$s_nhasanxuat=$_POST['selectNhaSanXuat'];
		$s_loaidochoi=$_POST['selectLoaiDoChoi'];
		$s_xuatxu=$_POST['selectXuatXu'];
		$s_mota=$_POST['textMoTa'];

		$sqlstr = "UPDATE dochoi SET TenDoChoi='$s_tendochoi',
									GiaBan=$s_giaban,
									HinhAnh='$s_hinhanh',									
									MoTa='$s_mota',
									IDNhaSanXuat=$s_nhasanxuat,
									IDLoaiDoChoi=$s_loaidochoi,
									IDXuatXu=$s_xuatxu 
								WHERE ID = $s_ID
					";
		DataProvider::execQuery($sqlstr);
	
		//trở về trang đồ chơi
		//header("location:administrator.php?page=dochoi");
			
	}
?>

<?php
	$rowsPerPage=5; //1 lan load 10 trang
		$curPage=1; //trang hien tai
		if(isset($_GET['ppage'])){		
			$curPage = $_GET['ppage']; //trang hiện tại
		}//nếu đường dẫn có truyền page thì tham số page được dùng làm curPage
		$offset=($curPage-1)*$rowsPerPage; //tính offset bắt đầu load

    $sqlstr="SELECT * FROM dochoi";
    //------------------------------------------------------------------
        require_once("../DataProvider.php");
        $sqlstr="select *
                        from dochoi,nhasanxuat,loaidochoi,xuatxu 
                        where 
                        dochoi.IDLoaiDoChoi = loaidochoi.ID AND /*LẤY TÊN LOẠI ĐỒ CHƠI*/
                        dochoi.IDNhaSanXuat = nhasanxuat.ID AND /*LẤY TÊN NHÀ SẢN XUẤT*/
                        dochoi.IDXuatXu=xuatxu.ID ORDER BY dochoi.NgayTiepNhan DESC LIMIT $offset,$rowsPerPage         /*LẤY TÊN QUỐC GIA XUẤT XỨ*/
                 ";
        $result=DataProvider::execQuery($sqlstr);  
		             
        $tong_san_pham=mysql_num_rows($result);
		
		//PHÂN TRANG
	
		$sqlstr="select * from dochoi";		
        $result2=DataProvider::execQuery($sqlstr);		
		$number_of_rows=mysql_num_rows($result2);	//số lượng record sản phẩm
		$numbers_of_pages=ceil($number_of_rows/$rowsPerPage); //làm tròn lên, vd: 1.4 -> 2
		
/*KIỂM TRA TỔNG SẢN PHẨM CÓ LỚN HƠN 0*/         		
        if($tong_san_pham>0)
        {
            $san_pham=DataProvider::Lay_Danh_Sach_Chi_Tiet_Bang_Truy_Van($result); 
            ?>
<!-----------DIV CHỨA THÔNG TIN CHI TIẾT TỪNG ĐỒ CHƠI---------------------->                   
<div class="bangdulieu">
            <table>
               <thead>
                <tr>
                    <th width="18">ID</th>
                    <th width="155">tên đồ chơi</th>
                    <th width="36">hình ảnh</th>
                    <th width="324">mô tả</th>
                    <th width="66">giá bán</th>
                    <th width="76">ngày tiếp nhận</th>
                    <th width="28">xem</th>
                    <th width="36">đã bán</th>
                    <th width="56">nhà SX</th>
                    <th width="89">loại đồ chơi</th>
                    <th width="58">xuất xứ</th>   
                    <th width="79">thao tác</th>  
                            
                </tr>
             </thead>  
             
             
            <?php
            for($i=0;$i<$tong_san_pham;$i++)
            { /*XUẤT THÔNG TIN TỪNG SẢN PHẨM ĐỒ CHƠI*/
            ?>
                
                <tr>
                    <td><?php echo $san_pham[$i]['dochoi.ID']; ?></td>
                    <td style="max-width: 120px;"><span class="button2"><?php echo $san_pham[$i]['dochoi.TenDoChoi']; ?></span></td>
                    <td><img width="35px" src="./../img/<?php echo $san_pham[$i]['dochoi.HinhAnh']; ?>" /></td>
                    <td><div style="max-width: 300; max-height:80px; overflow: auto;   font-size:9pt; font-style:italic; font-height:35px; text-align:justify; padding:4px; color:gray;"><?php echo $san_pham[$i]['dochoi.MoTa']; ?></div></td>
                    <td><?php echo number_format($san_pham[$i]['dochoi.GiaBan']); ?></td>
                    <td><?php echo date('h:m - d/m',strtotime($san_pham[$i]['dochoi.NgayTiepNhan'])); ?></td>
                    <td><?php echo $san_pham[$i]['dochoi.SoLuotXem']; ?></td>
                    <td><?php echo $san_pham[$i]['dochoi.SoLuongBan']; ?></td>
                    <td><?php echo $san_pham[$i]['nhasanxuat.TenNSX']; ?></td>
                    <td style="max-width: 80px;"><?php echo $san_pham[$i]['loaidochoi.TenLoaiDoChoi']; ?></td>
                    <td><?php echo $san_pham[$i]['xuatxu.TenQuocGia']; ?></td>
                    <td><a href="administrator.php?page=dochoi&do=xoa&id=<?php echo $san_pham[$i]['dochoi.ID']; ?>" title="xoá sản phẩm này" onclick="return confirm('bạn có chắc muốn xoá');"><img src="../skin/img/xdelete.png" /></a>
                   		 <a href="administrator.php?page=dochoi&do=sua&id=<?php echo $san_pham[$i]['dochoi.ID']; ?>" title="sửa sản phẩm này" ><img src="../skin/img/edit.gif" /></td>
                </tr>
                
            
            <p>
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
						echo "<strong class=\"button3\" >$page</strong>&nbsp;&nbsp;";
					}
					else echo "<a  class=\"button4\" href='administrator.php?page=dochoi&ppage=$page'>$page</a>&nbsp;&nbsp;";
				}
			
		  ?></td>
      </tr>
    </table>
    <a href="sach.php?page=<?php echo $numbers_of_pages; ?>"></a>
    
    
</div>
<!-----------END: DIV CHỨA THÔNG TIN CHI TIẾT TỪNG ĐỒ CHƠI---------------------->        

<?php
    } /*END - KIỂM TRA TỔNG SẢN PHẨM CÓ LỚN HƠN 0*/         
?> 
</p>
 <!----------------------FORM NHẬP SẢN PHẨM ĐỒ CHƠI-------------------------->     
 <script type="text/javascript" src="file/js/form/form_dochoi.js"></script>        
 <div class="form_nhap" style="width:980px;border:1px silver dashed;  margin:15p auto;"> 
            <form id="form_dochoi" name="form1" method="post" action="administrator.php?page=dochoi" onsubmit="return check_form_dochoi(this);">
              <div align="center">
                <table class="bangnhaplieu" width="982" border="1" cellpadding="10" cellspacing="0" bordercolor="#CCCCCC">
                  <tr>
                    <td colspan="4" bgcolor="#666666"><div align="center">EDITOR</div></td>
                  </tr>
                  <tr>
                    <td><span>
                      <h4 align="right">MÃ ID</h4>
                      </span>
                      <input class="button2" name="textID" type="hidden"  id="textID" value="<?php echo (isset($flag) && $flag==true)?$s_ID:'auto'; ?>"/></td>
                    <td colspan="2">
                    	<div style="margin-left:15px">
                      <input onclick="alert(this.value);" class="button4" name="hienthiID" type="button"  id="textID2" value="<?php echo (isset($flag) && $flag==true)?$s_ID:'?'; ?>"/>
                    </div>
                    
                    </td>
                    <td width="32%" rowspan="5">
                    		<div align="center">
                    		  <?php
							if(isset($s_hinhanh))
							{
							?>
                    		  <img width="150" src="./../img/<?php echo $s_hinhanh; ?>" /></div>
							<?php
							}
							?>
                    </td>
                  </tr>
                  <tr>
                    <td width="28%"><div align="right">tên đồ chơi <span class="red">*</span></div></td>
                    <td width="40%" colspan="2"><input name="textTenDoChoi" type="text" id="textTenDoChoi" size="30" value="<?php echo (isset($flag) && $flag==true)?$s_tendochoi:''; ?>"/></td>
                  </tr>
                  <tr>
                    <td><div align="right">hình ảnh</div></td>
                    <td colspan="2"><input name="textHinhAnh" type="text" id="textHinhAnh" size="30" value="<?php echo (isset($flag) && $flag==true)?$s_hinhanh:''; ?>"/>
                      <input type="button" class="button2" name="buttonBrowser" id="buttonBrowser" value="chọn ảnh" onclick="openUploader();"/></td>
                  </tr>
                  <tr>
                    <td><div align="right">giá bán <span class="red">*</span></div></td>
                    <td colspan="2"><input type="text" name="textGiaBan" id="textGiaBan" value="<?php echo (isset($flag) && $flag==true)?$s_giaban:''; ?>"/></td>
                  </tr>
                  <tr>
                    <td><div align="right">nhà sản xuất <span class="red">*</span></div></td>
                    <td colspan="2"><select name="selectNhaSanXuat" id="selectNhaSanXuat">
                      <option value="-1">--chọn nhà sản xuất--</option>
                      <?php //LOAD DỮ LIỆU VÀO COMBOBOX
                                        
                				  		$sqlstr="select * from nhasanxuat";
                						$result=DataProvider::execQuery($sqlstr);
                                        
                                        while($row=mysql_fetch_array($result))
                                        {?>
                      <option value="<?php echo $row[0];?>" <?php echo (isset($flag) && $flag==true && $row[0]==$s_nhasanxuat)?'selected':'';?>><?php echo $row[1];?></option>
                      <?php 
                                        }?>
                    </select></td>
                  </tr>
                  <tr>
                    <td height="44"><div align="right">loại đồ chơi <span class="red">*</span></div></td>
                    <td><select name="selectLoaiDoChoi" id="selectLoaiDoChoi">
                      <option value="-1">--chọn loại đồ chơi--</option>
                      <?php //LOAD DỮ LIỆU VÀO COMBOBOX
                                        
                				  		$sqlstr="select * from loaidochoi";
                						$result=DataProvider::execQuery($sqlstr);
                                        
                                        while($row=mysql_fetch_array($result))
                                        {?>
                      <option value="<?php echo $row[0];?>" <?php echo (isset($flag) && $flag==true && $row[0]==$s_loaidochoi)?'selected':'';?>><?php echo $row[1];?></option>
                      <?php 
                                        }?>
                    </select></td>
                    <td>
                    	<div>
                    	  <div align="right">xuất xứ <span class="red">*</span></div>
                    	</div>
                    </td>
                    <td width="32%"><select name="selectXuatXu" id="selectXuatXu">
                      <option value="-1">--chọn quốc gia--</option>
                      <?php //LOAD DỮ LIỆU VÀO COMBOBOX
                                        
                				  		$sqlstr="select * from xuatxu";
                						$result=DataProvider::execQuery($sqlstr);
                                        
                                        while($row=mysql_fetch_array($result))
                                        {?>
                      <option value="<?php echo $row[0];?>" <?php echo (isset($flag) && $flag==true && $row[0]==$s_xuatxu)?'selected':'';?>><?php echo $row[1];?></option>
                      <?php 
                                        }?>
                    </select></td>
                  </tr>
                  <tr>
                   
                  </tr>
                  <tr>
                    <td><div align="right">mô tả</div></td>
                    <td colspan="2"><div style="margin-left:15px;">
                      <textarea name="textMoTa" id="textMoTa" rows="10" cols="40"><?php echo (isset($flag) && $flag==true)?$s_mota:''; ?></textarea>
                      <br />
                      <script language="javascript1.2" type="text/javascript">make_wyzz('textMoTa');</script>
                    </div></td>
                    <td>&nbsp;</td>
                  </tr>
                </table>            
                <p>
                  <?php //ẨN NÚT THÊM KHI CHƯA CHỌN SỬA ĐỒ CHƠI
						if(isset($_GET['do']) && ($_GET['do'] == 'sua') && isset($flag) && $flag==true)
						{
					?>                
                  <input class="button3" type="submit" name="buttonSua" id="buttonSua" value="câp nhật sản phẩm này"/>
                  <input class="button3" type="submit" name="buttonThem" id="buttonThem" value="thêm mới sản phẩm này"/> 
                  <a href="administrator.php?page=dochoi" class="button2">Huỷ cập nhật</a>
                  
                  <?php
						}
                        
                    if(!(isset($_GET['do']) && $_GET['do']=='sua'))
				  {?>
                  <input class="button3" type="submit" name="buttonThem" id="buttonThem" value="thêm sản phẩm"/>
                </p>               
                <?php } ?>
               
              </div>
            </form> 
  </div>
  
   <!----END FORM NHẬP SẢN PHẨM ĐỒ CHƠI---->