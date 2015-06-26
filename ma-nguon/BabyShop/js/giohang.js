// JavaScript Document
function xoa_het_gio_hang()
{
	
	$(".button_thanhtoan").css("visibility","hidden");
	$(".item_detail_giohang").remove();
	$(".tieude_giohang").html("giỏ hàng rỗng");
	$("li.menu_giohang").html("(0) deleted");
	$("li.menu_giohang").css("background","#FF99CC");
		$.post('module/chinhsuagiohang.php',{post_do:1},
				function(data){
							$('#result').html(data);								
							
				});
				tinhlaitien();
}
function ThayDoiSoLuong(k,num){
											
		if(num==(+1)){
			var soluong=parseInt(k.innerHTML);
			soluong++;
			k.innerHTML=soluong;
		}
		if(num==(-1)){
			var soluong=parseInt(k.innerHTML);
			if(soluong>1)
			{
				soluong--;
				k.innerHTML=soluong;
			}
		}
		tinhlaitien();
}

function xoa_mot_san_pham_trong_gio_hang(id){
		$.post('module/chinhsuagiohang.php',{post_xoaID:id},
				function(data){				
					$('#result').html(data);
				});
			$("#item_detail_giohang_"+id).remove();
			
			var sosanpham = $(".item_detail_giohang").length;
			$(".tieude_giohang").html("còn "+sosanpham+" trong giỏ hàng");
			$("li.menu_giohang").html("<img src=\"skin/img/cart_out.png\" /> ("+sosanpham+")");
			$("li.menu_giohang").css("width","150px");
			tinhlaitien();
			
			if(sosanpham==0){
				window.location="index.php";
			}
}		
function tinhlaitien()
{
	var tong_tien=0;
	var dinh_dang_tong_tien;
	var mang_gia_tien=new Array();
	var mang_so_luong = new Array();
	
	 $('.tien_items').each(function(index ) { 
				
				var str = $(this).html();	
				str = str.replace(/ /g, '');
				var find = ' ';
				var re = new RegExp(find, 'g');
				str = str.replace(re, '');	
				str=parseFloat(str);
				mang_gia_tien[index]=str;
																  
		});
		   $('.textSoLuong ').each(function(index ) { 
				
				var str = $(this).html();	
				str = str.replace(/ /g, '');
				var find = ' ';
				var re = new RegExp(find, 'g');
				str = str.replace(re, '');	
				str=parseFloat(str);
				mang_so_luong[index]=str;                                                   	
		});
		
		for(var i=0; i<mang_gia_tien.length; i++){
			tong_tien+=mang_gia_tien[i]*mang_so_luong[i]	
		}
		var doc_tong_tien = docso(tong_tien);
		dinh_dang_tong_tien=tong_tien.toLocaleString();
	   
	   $("#tong_tien").html(dinh_dang_tong_tien); //xuất ra ô tổng tiền
	   $(".doc_tien").html(doc_tong_tien);
	   $("#so_luong_san_pham").html(mang_so_luong.join('/'));
}
function thanh_toan_tien(){
		
		var soluongsanpham = $('#so_luong_san_pham').html();
		$.post('module/thanhtoan.php',{postsoluongsanpham:soluongsanpham},
				function(data){
					$(".chucnang_chonsoluong, .xoamot").remove().hide(); //không cho thao tác nữa												
					$('#result').html(data);
				});
		
}

										