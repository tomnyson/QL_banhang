<?php
session_start();
require_once("DataProvider.php"); 
require_once("cls/trangthai.php");
//tạo mảng session chứa id giỏ hàng sản phẩm nếu chưa tồn tại
if(!isset($_SESSION['giohang_ID'])){
    $_SESSION['giohang_ID']=array();
}
//đặt sesion thống kê lượt truy cập
if(!isset($_SESSION['nguoitruycap'])){
    $_SESSION['nguoitruycap']='dangtruycap';
    DataProvider::Tang_1_Luot_Truy_Cap();
	
}
//thống kê truy cập
require_once("module/thongketruycap.php");
$soluongsanphamtronggiohang=count($_SESSION['giohang_ID']);
?> 
<!--------------------------------- <html> ------------------------------------------->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
       	<link rel="shortcut icon" href="skin/img/favicon.ico" />        
		<title>Baby shop</title>
         <!-----------------css------------->
		<link rel="stylesheet" type="text/css" href="skin/css/main.css" />
        <link rel="stylesheet" type="text/css" href="skin/css/div.css" />
        <link rel="stylesheet" type="text/css" href="skin/css/form.css" />
        <link rel="stylesheet" type="text/css" href="skin/css/button.css" />
        <link href="skin/css/css3menu.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="skin/css/search_box.css" />
		<link rel="stylesheet" type="text/css" href="skin/css/slider-top-elastislide.css" />
		<link rel="stylesheet" type="text/css" href="skin/css/slider-top-custom.css" />
		<script src="js/modernizr.custom.17475.js"></script>
        
        <!-----------------SCRIPT/ jquery------------->
      	<script src='js/jquery-1.8.3.min.js'></script>
        <script src='js/jquery-ui.js'></script>
        <script src='js/jquery.js'></script>
        <script src='js/jquery.timmer.js'></script>
        
        <script type="text/ecmascript" src="js/script_index.js"></script>
    <!-----------------/jquery-------------->
	</head> <!--------------------------------- <end HEAD> ------------------------------------------->
	<body>   	
            	<!--HEADER-->
			<div id="header">	
            
           <!-- THANH MENU ẢNH SẢN PHẨM TRƯỢT NGANG-->	
				<ul id="carousel" class="elastislide-list">
                	<li><embed src="skin/img/banner1.swf" quality="high" type="application/x-shockwave-flash" wmode="transparent" width="1280" height="200" pluginspage="http://www.macromedia.com/go/getflashplayer" allowScriptAccess="always"></embed></li>
					<li><img  src="skin/img/banner1_02.jpg" alt="" /></li>        
				</ul>
	
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>		
		<script type="text/javascript" src="js/jquery.elastislide.js"></script> 
		<script type="text/javascript">$( '#carousel' ).elastislide();</script>	
		 <!-- End THANH MENU ẢNH SẢN PHẨM TRƯỢT NGANG-->				
			
		</div><!--END : HEADER-->
		<!-------------------------------------CONTAINER-------------------------------------------------->
		<div id="container" >
                            <!-----------THANH MENU LENH---------------->  
                                <!--THANH MENU NGANG-->  
                                <div class="thongbao3">
                                <ul class="navigation">
                                    <!--TRANG CHỦ-->
                                    <a href="index.php">
                                        <li <?php echo (!isset($_GET['page']))?"class='active3d'":"";  ?>>
                                                    <img width="25px" src="skin/img/home_mini.png" /> 
                                                    trang chủ
                                        </li>
                                    </a>
                                     <!--GIỎ HÀNG-->
                                     <a href="index.php?page=giohang">    
                                    <li class="menu_giohang" <?php echo (isset($_GET['page'])&&$_GET['page']=='giohang')?"style='background:#FF9;box-shadow:0px 0px 15px #666666;'":"";?>>
                                                                                
                                           <?php if($soluongsanphamtronggiohang==0){?>
                                                                    <img src="skin/img/cart.png" />
                                            <?php }else{?>
                                                                     	<img src="skin/img/cart_full.png" width="24px" height="24px"/><?php }
																	 ?>
                                                            giỏ hàng (<?php echo $soluongsanphamtronggiohang;?>)
                                                
                                    </li>
                                    </a>
                                    <!--HIỆN ĐĂNG NHẬP KHI ĐĂNG KÝ KHI USER CHƯA ĐĂNG NHẬP-->                                      
                                    <?php if(trangthai::is_login()==false)
                                    { ?>
                                        			<a href="index.php?page=login">
                                                    <li id="li_dangnhap" <?php echo (isset($_GET['page'])&&$_GET['page']=='login')?"class='active3d'":"";?>>
                                                        <img width="25px" src="skin/img/login_mini.png" />
                                                        đăng nhập
                                                       
                                                    </li> </a>
													
                                                     <a href="index.php?page=sign-up">
                                                    <li id="li_dangky" <?php echo (isset($_GET['page'])&&$_GET['page']=='sign-up')?"class='active3d'":"";?>>
                                                       <img width="25px" src="skin/img/sign_up.png" /> 
                                                        đăng ký
                                                    </li> </a>
									<?php		                                    
                                     }                                   
                                    ?>	      
                                 <!---------NẾU LÀ ADMIN THÌ MỚI CHO HIỆN ADMINISTRATOR-------->
                                    <?php                                    
                                    if(trangthai::is_admin()) 
                                    { 
                                    ?><li><a href="./admin/index.php"><img width="25px" src="skin/img/administrator_mini.png" /> administrator</a></li>
                                    <?php }?>
                                </ul>
                                 <!-----------KẾT THÚC THANH MENU LENH---------------->    
                                 
                                 <!------------ FORM TIM KIẾM-------------->
                               		<?php require_once("module/form_timkiem.php");?>
                                 <!-----------END TIM KIEM---------------->       
                                                             
                                </div>          
                                    <!--HIỆN MENU USER NẾU ĐÃ ĐĂNG NHẬP-->
                                    <?php
                                        if(trangthai::is_login()==true)
                                        {
                                            require_once("module/menu_user.php");                                            
                                        }
                                    ?>                                    
                                 <!--END THANH MENU NGANG-->                                
                       <!-----------END THANH MENU LENH---------------->
 <!--------------------------------- <end> ------------------------------------------->                       