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
	 fld.style.boxShadow="0px 0px 25px red";
}
function check_form_loaidochoi(frm)
{
	if(frm.textTenLoaiDoChoi.value.length==0)
	{
		return Yellow(frm.textTenLoaiDoChoi,"bạn chưa nhập tên loại đồ chơi");
	}White(frm.textTenLoaiDoChoi);
	return true;
}