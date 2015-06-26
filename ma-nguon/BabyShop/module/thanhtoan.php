<?php
	$mang_soluongsanpham=$_POST['postsoluongsanpham'];	
?>
<?php
	//trường hợp user đã đăng nhập
	$flag=false;
	$thanhvien=array();
	if(isset($_SESSION['user']['ID']))
	{
		$thanhvien=DataProvider::Lay_Thong_Tin_Thanh_Vien_Dua_Vao_ID($_SESSION['user']['ID']);		
		$flag=true;
	}

?>
<div>

  <form id="form1" name="form1" method="post" action="" onsubmit="return kiemtra(this);">
    <div align="center">
      <table width="487" border="0">
        <tr>
          <td colspan="2" bgcolor="#CCCCCC"><div align="center">đơn hàng</div></td>
        </tr>
        <tr>
          <td width="175"><div align="right"><label>họ tên khách hàng (*</label>)</div></td>
          <td width="302"><input type="text" name="textTenKhachHang" id="textTenKhachHang" />
          <input type="hidden" name="hiddenSoLuongTungSanPham" id="hiddenSoLuongTungSanPham" value="<?php echo $mang_soluongsanpham;?>"/></td>
        </tr>
        <tr>
          <td><div align="right"><label>số điện thoại (*)</label></div></td>
          <td><input type="text" name="textSoDienThoai" id="textSoDienThoai" /></td>
        </tr>
        <tr>
          <td><div align="right"><label>địa chỉ email</label></div></td>
          <td><input type="text" name="textEmail" id="textEmail" /></td>
        </tr>
        <tr>
          <td><div align="right"><label>	địa chỉ nhận hàng (*)</label></div></td>
          <td><textarea name="textDiaChiNhanHang" cols="35" rows="5" id="textDiaChiNhanHang"></textarea></td>
        </tr>
        <tr>
          <td><div align="right">
           </div></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><div align="center">
            <input type="submit" name="buttonDatHang" id="buttonDatHang" value="đặt hàng" class="button3" />
          </div></td>
        </tr>
      </table>
    </div>
  </form>

</div>
<script>
	function kiemtra(s){
		if(s.textTenKhachHang.value.length=='')
		{
			alert("bạn chưa nhập tên khách hàng");
			s.textTenKhachHang.style.background="#F8E0E0";
			return false;	
		}s.textTenKhachHang.style.background="white";
		
		
		if(s.textSoDienThoai.value.length=='')
		{
			alert("bạn chưa nhập số điện thoại");
			s.textSoDienThoai.style.background="#F8E0E0";
			return false;	
		}s.textSoDienThoai.style.background="white";
		
		
		
		if(s.textEmail.value.length!=''){
			if(!validEmail(s.textEmail.value)){
					alert("email của bạn không hợp lệ");
				s.textEmail.style.background="#F8E0E0";
				return false;	
			}
		}s.textEmail.style.background="white";
		
		
		if(s.textDiaChiNhanHang.value.length=='')
		{
			alert("bạn chưa nhập địa chỉ nhận hàng");
			s.textDiaChiNhanHang.style.background="#F8E0E0";
			return false;	
		}s.textDiaChiNhanHang.style.background="white";
		alert("cám ơn "+s.textTenKhachHang.value+" đã đặt hàng,\n - chúng tôi sẽ nhanh chóng chuyển hàng tới cho bạn!, \n - rất hân hạnh được phục vụ");
		
		return true;
	}
	
	
	
function validEmail(e) {
    var filter = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
    return String(e).search (filter) != -1;
}

function kt_phone(inputtxt)
      { 
          var letters = /^[A-Za-z0-9]+$/;
          if(!inputtxt.value.match(letters))
          {
             alert('tên đăng nhập không được chứa ký tự đặc biệt');
              inputtxt.style.backgroundColor="red";
              return false; 
          } 
		  return true;
          
}


</script>