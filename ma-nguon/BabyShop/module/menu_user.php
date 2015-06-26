<style>
    .menu_dangnhap{
        
       
       
        position:absolute;
        top:0px;
        right:0px;
        width:170px;
        height:120px;
       
       
    }
    .menu_dangnhap a,a:link{
        color:red;
    }
     .menu_dangnhap a:hover{
        color:red;
    }
    
    li#li_dangxuat{
        list-style:url("skin/img/power1.png") inside;
      
    }
    li#li_thongtintaikhoan{
            margin-top:2px;
           
            font-weight:bold;
            
         border-radius:5px;
         list-style:url("skin/img/info.png") inside;
         background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(100%,rgba(255,255,255,0))); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* IE10+ */
            background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#00ffffff',GradientType=0 ); /* IE6-9 */
    }
 
    
      li#li_payhistory{
         list-style:url("skin/img/pay_history.png") inside;
    }
    
      li#li_messege{
         list-style:url("skin/img/mini_message.png") inside;
          
    }
    .menu_dangnhap ul li{
          transition: padding-left 0.5s;
        -webkit-transition:padding-left 0.5s;
        -moz-transition:padding-left 0.5s;
        -o-transition:padding-left 0.5s;
    }
    .menu_dangnhap ul li:hover{
        
        padding-left:10px;
        cursor:pointer;
    }
   
</style>
<div class="menu_dangnhap">
    <ul>
         <li id="li_thongtintaikhoan"><?php echo trangthai::get_username(); ?></li>          
    
        <li id="li_payhistory">lịch sử mua sắm</li>
        <li id="li_messege">tin nhắn (0)</li>
        <a href="index.php?page=logout"><li id="li_dangxuat">đăng xuất</li></a>    
        
    </ul>

</div>