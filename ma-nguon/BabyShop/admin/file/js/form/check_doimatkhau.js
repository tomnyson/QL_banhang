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

function check_doimatkhau(frm)
{
	if(frm.textMatKhauMoi.value.length<5)
	{
		return Yellow(frm.textMatKhauMoi,"mật khẩu mới phải lớn hơn 5 ký tự"); 
	}
    White(frm.textMatKhauMoi);
	if(frm.textXacNhanMatKhauMoi.value!=frm.textMatKhauMoi.value)
	{
		return Yellow(frm.textXacNhanMatKhauMoi,"xác nhận mật khẩu không khớp");
	}
	return true;
}

