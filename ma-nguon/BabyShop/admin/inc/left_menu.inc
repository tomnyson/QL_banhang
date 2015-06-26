<p><button id="anhien_menuleft" class="button1">ẩn menu</button></p>
                <div id="left">
                     <div class="menu">
                        <ul>
                            <p class="title">quản trị viên<img  src="../skin/img/admin.png" style="float:right;"/></p>
                            <a href="administrator.php?q=logout"><li class="dangxuat">đăng xuất</li>    </a>
                            <a href="administrator.php?page=doimatkhau"> <li class="doimatkhau">đổi mật khẩu</li></a>
                        </ul>
                    </div>
                    
                    <div class="menu">
                        <ul>
                            <p class="title">sản phẩm<img  src="../skin/img/product.png" style="float:right;"/></p>
                            <a href="administrator.php?page=dochoi"><li class="<?php echo (isset($_GET['page']) && ($_GET['page']=='dochoi'))?'active':'bt'; ?>">quản lý đồ chơi (<?php echo DataProvider::So_Luong_Do_Choi_Trong_CSDL(); ?>)</li></a>
                            <a href="administrator.php?page=nhasanxuat"><li class="<?php echo (isset($_GET['page']) && ($_GET['page']=='nhasanxuat'))?'active':'bt'; ?>">quản lý nhà sản xuất (<?php echo DataProvider::So_Luong_Nha_San_Xuat_Trong_CSDL(); ?>)</li></a>
                            <a href="administrator.php?page=loaidochoi"><li class="<?php echo (isset($_GET['page']) && ($_GET['page']=='loaidochoi'))?'active':'bt'; ?>">quản lý nhà loại đồ chơi (<?php echo DataProvider::So_Luong_Loai_Do_Choi_Trong_CSDL(); ?>)</li></a>
                      
                               
                    </div>
                    <div class="menu">
                        <ul>
                            <p class="title">thành viên<img  src="../skin/img/user.png" style="float:right;"/> </p>
                             <a href="administrator.php?page=thanhvien"><li  class="<?php echo (isset($_GET['page']) && ($_GET['page']=='thanhvien'))?'active':'bt'; ?>">quản lý thành viên (<?php echo DataProvider::So_Luong_Thanh_Vien_Trong_CSDL(); ?>)</li></a>    
                          
                        </ul>
                    </div>
                    <div class="menu">
                        <ul>
                            <p class="title">giao dịch<img  src="../skin/img/money.png" style="float:right;"/> </p>
                           <a href="administrator.php?page=donhang"><li  class="<?php echo (isset($_GET['page']) && ($_GET['page']=='donhang'))?'active':'bt'; ?>">quản lý đơn hàng (<?php echo DataProvider::So_Luong_Don_Hang_Trong_CSDL(); ?>)</li></a>    
                          
                        </ul>
                    </div>
                    
                    
                </div>
               