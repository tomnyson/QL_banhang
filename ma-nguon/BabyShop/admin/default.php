<div style="padding:20px;">
<h3>
chào mừng bạn đến với trang quản trị, 
chúc bạn vui vẻ!
</h3>
<hr />
<div class="thongke_admin">
    <p>đơn hàng <img src="../skin/img/hoadon.png" style="position:absolute; right:0px;"/></p>
        <ul>
            <li>có tất cả: <span class="button2none"><?php echo DataProvider::So_Luong_Don_Hang_Trong_CSDL(); ?></span> đơn hàng</li>  
          	
            <?php if(DataProvider::So_Luong_Don_Hang_Chua_Giao_Trong_CSDL()>0) {?>
           <a href="administrator.php?page=donhang"><li><span class="button2none" style="color:red; font-weight:bold;"><?php echo DataProvider::So_Luong_Don_Hang_Chua_Giao_Trong_CSDL(); ?></span> đơn hàng chưa giao cho khách</li>  </a><?php }  ?>
           
           
                      
        </ul>        
    </div>
    <div class="thongke_admin">
        <p>sản phẩm <img src="../skin/img/sanpham.png" style="position:absolute; right:0px;"/></p>
        <ul>
            <li>có tất cả: <span class="button2none"><?php echo DataProvider::So_Luong_Do_Choi_Trong_CSDL(); ?></span> sản phẩm đồ chơi</li>
            <li>có tất cả: <span class="button2none"><?php echo DataProvider::So_Luong_Nha_San_Xuat_Trong_CSDL(); ?></span> nhà sản xuất đồ chơi</li>
            <li>có tất cả: <span class="button2none"><?php echo DataProvider::So_Luong_Loai_Do_Choi_Trong_CSDL(); ?></span> loại đồ chơi</li>
        </ul>        
    </div>
    
     <div class="thongke_admin">
        <p>thành viên <img src="../skin/img/thanhvien.png" style="position:absolute; right:0px;"/></p>
        <ul>
            <li>có tất cả: <span class="button2none"><?php echo DataProvider::So_Luong_Thanh_Vien_Trong_CSDL(); ?></span> thành viên</li>   
            <li><span class="button2none" style="color:red; font-weight:bold;"><?php echo DataProvider::So_Luong_Thanh_Vien_Bi_Khoa(); ?></span> tài khoản thành viên bị vô hiệu hoá</li>  
            <li><span class="button2none"><?php echo DataProvider::So_Luong_Thanh_Vien_Trong_CSDL()-DataProvider::So_Luong_Thanh_Vien_Bi_Khoa(); ?></span> thành viên hoạt động bình thường</li>    
            
            <?php $thongtin_thanhvienmoinhat = DataProvider::Tra_Ve_Thong_Tin_Thanh_Vien_Moi_Nhat(); ?>
            <li>chào mừng thành viên mới nhất: <span class="button2none"><?php echo $thongtin_thanhvienmoinhat[1]; ?></span></li>    
                   
        </ul>        
    </div>
 <div class="clear"></div>

    

</div>