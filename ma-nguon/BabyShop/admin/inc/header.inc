<?php
    session_start();
    if(!isset($_SESSION['admin']) || $_SESSION['admin']!='admin')
    {
    	   header("location:index.php"); //nếu chưa đăng nhập thì chuyển về trang đăng nhập	
    }

    //nếu người dùng bấm đăng xuất
    if(isset($_GET['q']) && $_GET['q']=='logout')
    {
        unset($_SESSION['admin']);
        header("location:page/loadpaging.php");
       
    }
?>
<?php
    require_once("../DataProvider.php");
?>

<html>
    <head>  
        <meta http-equiv="content-type" content="text/html" charset="utf-8" />
        <title>admin - Baby Shop</title>
       <link rel="stylesheet" type="text/css" href="../skin/css/admin.css" /> 
       <link rel="stylesheet" type="text/css" href="../skin/css/form.css" /> 
        <link rel="stylesheet" type="text/css" href="../skin/css/button.css" /> 
        <link rel="stylesheet" type="text/css" href="../skin/css/div.css"/> 
          <script src='file/js/jquery.js'></script>	  
		   <script language="JavaScript" type="text/javascript" src="wyzz/wyzz.js"></script>
	  
                            <script>
							
                            $(document).ready(function(){
                                    /*ẨN HIỆN THANH MENU*/
                                    $("#anhien_menuleft").click(function(){
                                        $("#left").fadeToggle();                                        
                                        if($(this).html()=="ẩn menu"){
                                            $(this).html("hiện menu");
                                        }else{
                                            $(this).html("ẩn menu");
                                        }
                                     });                   
                                         /*SCROLL TRỞ XUỐNG DƯỚI NẾU ĐANG SỬA SẢN PHẨM*/
                                          /*SCROLL TRỞ XUỐNG DƯỚI NẾU BẤM VÀO THÊM SẢN PHẨM*/
                                       
                                    $.urlParam = function(name){
                                        var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
                                        return results[1] || 0;
                                    }
                                    if($.urlParam('do')=='sua' || $.urlParam('do')=='them')
                                    {
                                         $("#left").fadeToggle();
                                         $("#anhien_menuleft").html("hiện menu");
                                        $("#form_dochoi").css("visibility","visible");   
                                                                    
                                         $('html, body').animate({scrollTop:$(document).height()-350}, 'slow');                                  
                                         return false;
                                    }
                                    
                            });   
							
                            </script>
                            
                       
                     
	   
      <!--hàm dùng để mở file upload.php trong cửa số có kích thước 450 200 giữa màn hình-->
	
      <script>
	  
		  function openUploader2(){
			var width=450;
			var height=200;
			//xác định toạ độ cửa sổ
			var left=(screen.availWidth-width)/2;
			var top= (screen.availHeight-height)/2;
			//mở cửa số upload.php
			window.open("../img/upload2.php","","width="+width+",height="+height+",top="+top+",left="+left+",location=0,resizable=0");
			
	  }
	  
	  function openUploader(){
			var width=450;
			var height=200;
			//xác định toạ độ cửa sổ
			var left=(screen.availWidth-width)/2;
			var top= (screen.availHeight-height)/2;
			//mở cửa số upload.php
			window.open("../img/upload.php","","width="+width+",height="+height+",top="+top+",left="+left+",location=0,resizable=0");
			
	  }
	  
	  </script>

    </head>    
    <body>
	
        <div id="container">
            <div id="header">
                    <a href="administrator.php"><div class="logo"><img src="../skin/img/administrator.png" /></div></a>
                  
					<a href="../index.php" target="_blank"><div class="logo"><img src="../skin/img/home.png" /></div></a>
                    <div class="clear"></div>
            </div>
            