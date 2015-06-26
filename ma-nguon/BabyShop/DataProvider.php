<?php
    require_once("config.php");
    
	class DataProvider
	{
		/*HÀM THỰC THI MỘT CHUỖI LỆNH ĐƯA VÀO*/
		public static function execQuery($sqlstr)
		{
			//kết nối tới máy chủ
            $conn = mysql_connect(HOST,USER,PASS) or die("error: ".mysql_error());
            //hiển thị kết quả chuỗi dữ liệu là tiếng việt
          	mysql_query("SET NAMES 'UTF8'");
            //lựa chọn cơ sở dữ liệu sau khi kết nối
            mysql_select_db(DB,$conn) or die("error: ".mysql_error());
            //truy vấn với chuỗi tham số $sqlstr,
            $result = mysql_query($sqlstr,$conn);
            //đóng kết nối
            mysql_close($conn);
            //trả về kết quả fetch 
            return $result;
		}
		/*hàm chỉ trả về số dòng của 1 câu truy vấn*/
         public static function Tra_Ve_So_Dong_Truy_Van($sqlstr){       
             $result=DataProvider::execQuery($sqlstr);
             return mysql_num_rows($result);
        }
        
        
        
		/*delete,update*/
		public static function execNoneQuery($sqlstr)
		{
			//kết nối tới máy chủ
            $conn = mysql_connect(HOST,USER,PASS) or die("error: ".mysql_error());
            //hiển thị kết quả chuỗi dữ liệu là tiếng việt
          	mysql_query("SET NAMES 'UTF8'");
            //lựa chọn cơ sở dữ liệu sau khi kết nối
            mysql_select_db(DB,$conn) or die("error: ".mysql_error());
            //truy vấn với chuỗi tham số $sqlstr,
            $result = mysql_query($sqlstr,$conn);
			
            //đóng kết nối
            mysql_close($conn);
            //trả về kết quả fetch 
            return $result;
		}
      
		/*VÌ KHI LỰA CHỌN NHIỀU BẢNG, KẾT QUẢ TRẢ VỀ CÓ THỂ TRÙNG $ROW['tên cột'], hàm này sẽ trả về mảng 2 chiều $ROW[$i]['tên bảng.têncột']*/
        public static function Lay_Danh_Sach_Chi_Tiet_Bang_Truy_Van($result){
            $count=0; //biến đếm  = 0
            $qualifiedarray;
            while($basearray=mysql_fetch_array($result)){ //với mỗi đợt fetch sẽ ra số record tương ứng với số cột
                
                for ($i = 0; $i < mysql_num_fields($result); $i++) { //với mỗi cột 
                  
                    $table = mysql_field_table($result, $i);    //tên của bảng đang xét
                    $field = mysql_field_name($result, $i);     //tên của cột đang xét
                    
                    //ứng với mỗi dòng của mảng 2 chiều, ta nạp các thuộc tính  "tênbảng.têncột"=giá trị tương ứng vào
                    $qualifiedarray[$count][$table.".".$field]=$basearray[$i]; 
                    
                }
                $count++; //tăng chỉ số dòng của mảng 2 chiều lên
            }
            return $qualifiedarray; //trả về 1 mảng 2 chiều
        } 
        
        
		public static function Kiem_Tra_San_Pham_Co_Ton_Tai_Trong_Do_Choi($ID){
            $sqlstr="select * from dochoi where IDDoChoi=$ID";
            $result=DataProvider::execQuery($sqlstr);
            return $result;
            
             
        }
	   	/*CẬP NHẬT sản phẩm*/
		/*TĂNG 1 LƯỢT VIEW*/
        public static function Tang_Mot_Luot_Xem($ID){
            $sqlstr="UPDATE dochoi SET SoLuotXem = SoLuotXem+1 WHERE ID=$ID";
            DataProvider::execQuery($sqlstr);
        }
        /*TĂNG SỐ lần đã bán được của sản phẩm*/
    	public static function Tang_So_Luong_Da_Ban_Duoc($ID,$SL){
            $sqlstr="UPDATE dochoi SET SoLuongBan = SoLuongBan+$SL WHERE ID=$ID";
            DataProvider::execQuery($sqlstr);
        }
		/*lấy ra thông tin sản phẩm đồ chơi từ ID*/
		
		public static function Tra_Ve_Thong_Tin_1_Mon_Do_Choi($ID)
		{
			$sqlstr="select * from dochoi where ID = $ID";	
			$result = DataProvider::execQuery($sqlstr);
			$mang_thong_tin=array();
			$row = mysql_fetch_array($result);			
					$mang_thong_tin['ID']=$ID;
					$mang_thong_tin['TenDoChoi']=$row['TenDoChoi'];
					$mang_thong_tin['HinhAnh']=$row['HinhAnh'];
					$mang_thong_tin['MoTa']=$row['MoTa'];
					$mang_thong_tin['GiaBan']=$row['GiaBan'];
					$mang_thong_tin['NgayTiepNhan']=$row['SoLuotXem'];
					$mang_thong_tin['SoLuotXem']=$row['SoLuotXem'];
					$mang_thong_tin['SoLuongBan']=$row['SoLuongBan'];
					$mang_thong_tin['IDLoaiDoChoi']=$row['IDLoaiDoChoi'];
					$mang_thong_tin['IDNhaSanXuat']=$row['IDNhaSanXuat'];
					$mang_thong_tin['IDXuatXu']=$row['IDXuatXu'];		
			return $mang_thong_tin;
		}
		
		/*XOÁ*/
		public static function Xoa_Mot_San_Pham($ID){ //trả về đường dẫn bức ảnh của sản phẩm
        
            //lấy đường dẫn bức ảnh của nó
            $sqlstr="select HinhAnh from dochoi WHERE ID=$ID";  
			 $result=DataProvider::execQuery($sqlstr);
             $row = mysql_fetch_array($result);
             
             //xoá record dữ liệu trò chơi có ID
			 $sqlstr="DELETE FROM dochoi WHERE ID=$ID";  	
			 DataProvider::execQuery($sqlstr);
                          
            
             
			 return $row[0]; //trả về đường dẫn ảnh
		}
		
		public static function Xoa_Mot_Nha_San_Xuat($ID){ //trả về đường dẫn bức ảnh của sản phẩm
        
            //lấy đường dẫn bức ảnh của nó
            $sqlstr="select HinhAnh from nhasanxuat WHERE ID=$ID";  
			 $result=DataProvider::execQuery($sqlstr);
             $row = mysql_fetch_array($result);
             
             //xoá record dữ liệu trò chơi có ID
			 $sqlstr="DELETE FROM nhasanxuat WHERE ID=$ID";  	
			 DataProvider::execQuery($sqlstr);
                          
            
             
			 return $row[0]; //trả về đường dẫn ảnh
		}
		
      	/*get*/
		public static function Lay_Ten_Nha_San_Xuat_Tu_IDNhaSanXuat($ID){
				$sqlstr="select TenNSX from nhasanxuat where ID = $ID";	
				$result = DataProvider::execQuery($sqlstr);
				$row=mysql_fetch_array($result);
				return $row[0];
		}
		
			public static function Lay_Ten_Loai_Do_Choi_Tu_IDLoaiDoChoi($ID){
				$sqlstr="select TenLoaiDoChoi from loaidochoi where ID = $ID";	
				$result = DataProvider::execQuery($sqlstr);
				$row=mysql_fetch_array($result);
				return $row[0];
		}
        
        /*thống kê*/
		public static function So_Luong_San_Pham_Theo_Loai_San_Pham($ID){			
			return DataProvider::Tra_Ve_So_Dong_Truy_Van("select * from dochoi where IDLoaiDoChoi = $ID"); 	
		}
        public static function So_Luong_Do_Choi_Trong_CSDL(){
             return DataProvider::Tra_Ve_So_Dong_Truy_Van("select ID from dochoi"); 
        }
        public static function So_Luong_Loai_Do_Choi_Trong_CSDL(){
             return DataProvider::Tra_Ve_So_Dong_Truy_Van("select ID from loaidochoi");  
            
        }
     
        public static function So_Luong_Nha_San_Xuat_Trong_CSDL(){
           return DataProvider::Tra_Ve_So_Dong_Truy_Van("select ID from nhasanxuat");  
          
        }
        //
        public static function So_Luong_Thanh_Vien_Trong_CSDL(){
             return DataProvider::Tra_Ve_So_Dong_Truy_Van("select ID from user");  
        }
        //
		  public static function So_Luong_San_Pham_Cua_Mot_NSX($ID){
             return DataProvider::Tra_Ve_So_Dong_Truy_Van("select ID from dochoi where IDNhaSanXuat=$ID");  
        }
          public static function So_Luong_Don_Hang_Trong_CSDL(){
             return DataProvider::Tra_Ve_So_Dong_Truy_Van("select ID from donhang"); 
        }
		
		 public static function So_Luong_Don_Hang_Chua_Giao_Trong_CSDL(){
             return DataProvider::Tra_Ve_So_Dong_Truy_Van("select ID from donhang where TrangThai=0"); 
        }
         public static function So_Luong_Thanh_Vien_Bi_Khoa(){
            return DataProvider::Tra_Ve_So_Dong_Truy_Van("select ID from user where TrangThai=1");            
         }
		 
		 public static function Tra_Ve_Thong_Tin_Thanh_Vien_Moi_Nhat()
		 {
			$sqltr="select * from user order by NgayDangKy DESC limit 1";
			$result = DataProvider::execQuery($sqltr);
			return mysql_fetch_array($result);
				 
		 }
	   //thong ke truy cap
	   
	   public static function Tra_Ve_Tong_Luot_Truy_cap(){
		 	$sqlstr="select SoLuong from thongke WHERE ID=1";
			$result=DataProvider::execQuery($sqlstr);
			$row=mysql_fetch_array($result);
			return $row[0];
	   }
	   public static function Tang_1_Luot_Truy_Cap(){
		 	$sqlstr="UPDATE thongke SET SoLuong=SoLuong+1 WHERE ID=1";
			DataProvider::execQuery($sqlstr);		
	   }
	   /*ghi nhận thông tin người online vào csdl*/
       public static function Ghi_Nhan_Online($tg,$ip,$path){
          
            $sqlstr="insert into useronline(tgtmp,ip,local) values('$tg','$ip','$path')";
            DataProvider::execQuery($sqlstr);     
       }
	   public static function So_Luot_Nguoi_Dang_Online(){
	       	$sqlstr="SELECT DISTINCT ip FROM useronline WHERE local='".$_SERVER['PHP_SELF']."'";
            $query=DataProvider::execQuery($sqlstr); 
            return mysql_num_rows($query);          
	   }
       
       /*THANH VIEN*/
        public static function Mang_Thong_Tin_Thanh_Vien_Moi_Nhat(){
             $mangthongtin;            
        }
		public static function Khoa_Tai_Khoan($ID){
			$sqlstr="UPDATE user SET TrangThai=1 WHERE ID =$ID";
			DataProvider::execQuery($sqlstr);	
		}
		public static function Mo_Khoa_Tai_Khoan($ID){
			$sqlstr="UPDATE user SET TrangThai=0 WHERE ID =$ID";
			DataProvider::execQuery($sqlstr);	
				
		}
		public static function Kiem_Tra_Khoa_Tai_Khoan($ID){
			$sqlstr="select TrangThai from user where ID = $ID";
            $result = DataProvider::execQuery($sqlstr);
			$row = mysql_fetch_array($result);
    		return $row['TrangThai'];
		}
        /*LẤY THÔNG TIN THÀNH VIÊN DỰA VÀO TÊN TÀI KHOẢN*/
		public static function Lay_Thong_Tin_Thanh_Vien_Dua_Vao_ID($ID){
				$sqlstr="select * from user where taikhoan=$ID";
				$result=DataProvider::execQuery($sqlstr);
				$row=mysql_fetch_array($result);
				return $row;
				
				
				
		}
        /*THANH PHO*/
        public static function Lay_Ten_Thanh_Pho($ID){
            $sqlstr="select TenThanhPho from thanhpho where ID = $ID";
            $result = DataProvider::execQuery($sqlstr);
            $row=mysql_fetch_array($result);
           return $row[0];
            
        }
				/**/
      
	}	
?>	