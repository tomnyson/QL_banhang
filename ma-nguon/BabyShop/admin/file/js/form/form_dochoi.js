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
function check_form_dochoi(frm)
{  
    if(frm.textTenDoChoi.value.length==0){
        return Yellow(frm.textTenDoChoi,"bạn chưa nhập tên đồ chơi");
    } White(frm.textTenDoChoi);  
    
    
    if(isNaN(frm.textGiaBan.value)){
       return Yellow(frm.textGiaBan,"giá bán phải là số");
    }White(frm.textGiaBan);  
    
    
    if(frm.textGiaBan.value.length==0){
       return Yellow(frm.textGiaBan,"bạn chưa nhập giá tiền");
    }White(frm.textGiaBan);  
    
    
    if(frm.selectNhaSanXuat.value==-1){
       return Yellow(frm.selectNhaSanXuat,"bạn chưa chọn nhà sản xuất");
    }White(frm.selectNhaSanXuat);  
    
    
    if(frm.selectLoaiDoChoi.value==-1){
       return Yellow(frm.selectLoaiDoChoi,"bạn chưa chọn loại đồ chơi"); 
    }White(frm.selectLoaiDoChoi);  
    
    
    if(frm.selectXuatXu.value==-1){
       return Yellow(frm.selectXuatXu,"bạn chưa chọn xuất xứ đồ chơi");
    }White(frm.selectXuatXu);  
    
  // var textHinhAnh = frm.textHinhAnh;

    if(frm.textMoTa.value.length>2000){
       return Yellow(frm.textMoTa,"-mô tả chỉ được tối đa 2000 ký tự");
    }White(frm.textMoTa);  
   
   
   
    return true;
}