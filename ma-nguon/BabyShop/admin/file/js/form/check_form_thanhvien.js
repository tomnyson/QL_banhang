// JavaScript Document
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
function check_form_thanhvien(frm)
{
	if(frm.textTaiKhoan.value.length<5)
	{
		return Yellow(frm.textTaiKhoan,"tên tài khoản phải lớn hơn 5 ký tự"); 	
	}White(frm.textTaiKhoan);
	
	  if(allLetter(frm.textTaiKhoan)==false)return false; //kiểm tra username anphabeta
         White(frm.textTaiKhoan);
	
	
	 if(frm.textEmail.value=="")
        {
             return Yellow(frm.textEmail,"bạn chưa nhập địa chỉ email!");
           
        }
		
	return true;	
	
}