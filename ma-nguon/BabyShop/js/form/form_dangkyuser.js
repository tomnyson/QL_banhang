function validEmail(e) {
    var filter = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
    return String(e).search (filter) != -1;
}

function allLetter(inputtxt)
      { 
          var letters = /^[A-Za-z0-9]+$/;
          if(!inputtxt.value.match(letters))
          {
             alert('tên đăng nhập không được chứa ký tự đặc biệt');
              inputtxt.style.backgroundColor="yellow";
              return false; 
          } 
          return true; 
}
function Yellow(fld,msg)
{
    fld.style.backgroundColor="yellow";
    alert(msg);
    return false;
}
function White(fld)
{
    fld.style.backgroundColor="white";
}
function check_dangkyuser(form)
	{
      
         var textHoVaTen =		       form.textHoVaTen.value;
         if(textHoVaTen.length==0)
         {            
            return Yellow(form.textHoVaTen,"bạn chưa nhập họ tên");             
         }         
         White(form.textHoVaTen);
         
         
         var selectNgay =		       form.selectNgay.value;
         if(selectNgay==-1)
         {
             return Yellow(form.selectNgay,"bạn chưa chọn ngày sinh");
        
         }         
         White(form.selectNgay);
         
         
         var selectThang =		       form.selectThang.value;  
         if(selectThang==-1)
         {
             return Yellow(form.selectThang,"bạn chưa chọn tháng sinh");
 
         }     
         White(form.selectThang);
         
         
         var selectNam =		       form.selectNam.value;
         if(selectNam==-1)
         {
             return Yellow(form.selectNam,"bạn chưa chọn năm sinh");
      
         }   
         White(form.selectNam);  
         
         
       
         var selectNoiSong =		   form.selectNoiSong.value;
         if(selectNoiSong==-1)
         {
             return Yellow(form.selectNoiSong,"bạn chưa chọn nơi sống");
            
         }  
         White(form.selectNoiSong);     
         
         
         
          var textEmail =form.textEmail.value;
        if(!validEmail(textEmail))
        {
             return Yellow(form.textEmail,"địa chỉ email không hợp lệ!");
           
        }
        White(form.textEmail);
        
        
        
		var textTenDangNhap =		       form.textTenDangNhap.value;
              
         if(textTenDangNhap.length<5)
         {
             return Yellow(form.textTenDangNhap,"tên đăng nhập phải từ 5 ký tự trở lên");
        
         }  
        if(allLetter(form.textTenDangNhap)==false)return false; //kiểm tra username anphabeta
         
         White(form.textTenDangNhap);
         
         
         
        var textMatKhau =	          	form.textMatKhau.value;
         if(textMatKhau.length<5)
         {
             return Yellow(form.textMatKhau,"mật khẩu phải từ 5 ký tự trở lên");
         
         }  
         White(form.textMatKhau);
         
         
        var textTenXacNhanMatKhau =		form.textTenXacNhanMatKhau.value;
        if(textMatKhau!=textTenXacNhanMatKhau)
        {
             return Yellow(form.textTenXacNhanMatKhau,"mật khẩu xác nhận không khớp");
        
        }
        White(form.textTenXacNhanMatKhau);
        
        
        
        var textMaKiemTra =	      	form.textMaKiemTra.value;         
         if(textMaKiemTra.length=="")
         {
             return Yellow(form.textMaKiemTra,"bạn chưa nhập mã kiểm tra");
          
         }   
         White(form.textMaKiemTra);     
         
         
           
        var hiddenMaKiemTra =form.hiddenMaKiemTra.value;
        if(hiddenMaKiemTra!=textMaKiemTra)
        {
             return Yellow(form.textMaKiemTra,"mã kiểm tra chưa đúng");
           
        }
        White(form.textMaKiemTra);
        
      
		return true;

	}	
