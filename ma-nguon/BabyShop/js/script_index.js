// JavaScript Document

/*menu chạy theo khi scroll*/
 /*   $(function() {
 
    // grab the initial top offset of the navigation 
    var sticky_navigation_offset_top = $('.menu_giohang').offset().top; //vị trí top ban đầu của div menu nav
     
    // our function that decides weather the navigation bar should have "fixed" css position or not.
    var sticky_navigation = function(){
        var scroll_top = $(window).scrollTop(); // our current vertical position from the top
         
        // if we've scrolled more than the navigation, change its position to fixed to stick to top,
        // otherwise change it back to relative
        if (scroll_top > sticky_navigation_offset_top) {  //nếu mà cái vị trí cuộn > vị trí ban đầu của div nav
            $('.menu_giohang').css({ 'position': 'fixed', 'top':0, 'left':0 }); //thì nó sẽ được gán là cố định fixed 
        } else {
            $('.menu_giohang').css({ 'position': 'relative' });  //còn ngược lại thì trả về trạng thái không cố định
        }   
    };
     
    // run our function on load
    sticky_navigation(); //chạy 1 lần khi trang bắt đầu load
     
    // and run it again every time you scroll
    $(window).scroll(function() {
         sticky_navigation();		 //sự kiện mỗi khi cuộn chuột thì bắt đầu gọi hàm trên
    });
 
});*/
	   				/*ẨN HIỆN TÌM KIẾM NÂNG CAO CƠ BẢN*/
                	$(document).ready(function(){					
                      $(".timkiemnangcao").click(function(){
                        $(".div_timkiemnangcao").slideDown();
                      });
                      $(".close_div_timkiemnangcao").click(function(){
                        $(".div_timkiemnangcao").slideUp();
                        
                      });
					  
					  /*ẨN HIỆN THANH MENU*/
						$("#anhien_menuleft").click(function(){
							$(".menu").fadeToggle('slow');
							if($(this).html()=="ẩn"){
								$(this).html("hiện");
								$(".right").css("width","95%");  
							
							}else{
								$(this).html("ẩn");
								$(".right").css("width","970px");
								
							}
					 });
                });  
   
		
function them_vao_gio_hang(id){										 	
				
				$.post('module/themvaogiohang.php',{post_giohang_id:id},
						function(data){
						   //không cho thao tác nữa	
						  
						   $('#button_da_them_'+id).html(data);							
							var soluong = $(".tra_ve_so_luong_gio_hang_"+id).html();	
							$("li.menu_giohang").html("<img src=\"skin/img/cart_add.png\" width='25px'/> "+soluong+"");
								$("li.menu_giohang").css("background","#BDEC8A");
																
						});
				
		}
						