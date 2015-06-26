    <?php 
                                        
                                         //nếu người dùng nhấn vào nút tìm kiếm                                       
                                         if(isset($_GET['buttonTimKiem']))
                                         {
                                            require_once("timkiem.php"); 
                                         }else
                                         
                                         {   
                                         //nếu tồn tại biến page điều hướng
        									$page=(isset($_GET['page']))?$_GET['page']:'';
                                                
        										switch($page)
        										{
        										  
        											case 'show':    require_once("show.php"); break;       
        									   
        											case 'detail':  require_once("detail.php");  break;      
        											
        											case 'giohang':  require_once("giohang.php");  break;      
                                                    
                                                    case 'search':  require_once("timkiem.php");  break; 
        									   													
													case 'lienhe':  require_once("module/lienhe.php");  break; 
													
                                                    case 'logout':    require_once("module/dangxuat.php"); break;
													
                                                    case 'login':
                                                                    if(trangthai::is_login()==false)
                                                                    { 
                                                                     require_once("module/dangnhap.php");  break;
                                                                     }
                                                                     else
                                                                     {
                                                                        header("location:index.php"); break;
                                                                     }
                                                    
                                                   
                                                     
                                                    case 'sign-up':  require_once("module/dangky.php");  break; 
                                                    
                                                   
        											default:    require_once("default.php");    break;
        										}
                                        }
                                        
                                         
                                        //XỬ LÝ TÌM KIẾM AJAX KHI NGƯỜI DÙNG BẤM THẲNG VÀO GỢI Ý        
                                        $masanphamtimduoc=(isset($_GET['DenSanPhamTimDuoc']))?$_GET['DenSanPhamTimDuoc']:'';
                                        
                                        if(is_numeric($masanphamtimduoc))
                                        {
                                            header("location:index.php?page=detail&MaSanPham=".$masanphamtimduoc."&result=sanpham");
                                        }
                                        
                                        
                                        $maloaidochoitimduoc=(isset($_GET['DenLoaiDoChoiTimDuoc']))?$_GET['DenLoaiDoChoiTimDuoc']:'';
                                        
                                        if(is_numeric($maloaidochoitimduoc))
                                        {
                                            header("location:index.php?page=show&LoaiDoChoi=".$maloaidochoitimduoc."&result=loaidochoi");
                                        }
                                        
                                        $manhasanxuattimduoc=(isset($_GET['DenNhaSanXuatTimDuoc']))?$_GET['DenNhaSanXuatTimDuoc']:'';
                                        
                                        if(is_numeric($manhasanxuattimduoc))
                                        {
                                            header("location:index.php?page=show&HangSanXuat=".$manhasanxuattimduoc."&result=hangsanxuat");
                                        }
									
                                ?>