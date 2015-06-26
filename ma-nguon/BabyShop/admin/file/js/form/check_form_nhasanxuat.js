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
function check_form_nhasanxuat(frm)
{
	if(frm.textTenNSX.value.length==0)
	{
		return Yellow(frm.textTenNSX,"bạn chưa nhập tên nhà sản xuất");
	}White(frm.textTenNSX);
	return true;
}

