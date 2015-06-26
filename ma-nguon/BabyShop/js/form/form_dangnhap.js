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
function kiem_tra_dangnhap(f)
{
	f.textUsername.value;
	f.textPassword.value;
	if(f.textUsername.value.length==0){
		return Yellow(f.textUsername,"bạn chưa điền tên tài khoản");
		
	}White(f.textPassword);
	
	if(f.textPassword.value.length==0){
		return Yellow(f.textPassword,"bạn chưa điền mật khẩu");
		
	}White(f.textPassword);
}