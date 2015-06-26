<?php
require_once("inc/header.inc");
?>


<!----PHẦN THÂN CỦA TRANG----->
<button id="anhien_menuleft" class="button2">ẩn</button>
			<!--MIDDLE-->
			<div id="middle" >            
				<div class="left"> <!--------------------PHẦN MENU BÊN TRÁI: LEFT-------------------------->               
                    <?php require_once("inc/left_menu.inc"); ?>
                </div><!--KẾT THÚC MENU BÊN TRÁI-->
				<div class="right"><!--------------------PHẦN NỘI DUNG BÊN PHẢI: RIGHT--------------------------> 
				            <!-------------------LOAD NỘI DUNG VÀO ĐÂY------------------------------>
                            <!---------------------------------------------------------------------------->	
                                    	<?php require_once("dieuhuong.php"); ?>                                
                            <!---------------------------------------------------------------------------->	
                             <!---------------------------------------------------------------------------->	
				</div><!---END/ RIGHT-->		
			</div><!--END/ MIDDLE-->
            	
<!-----KẾT THÚC PHẦN THÂN CỦA TRANG----->     



<?php

    require_once("inc/footer.inc");
?>