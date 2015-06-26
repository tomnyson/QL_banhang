 <?php
                                    //LOAD CẬP NHẬT TOÀN BỘ DỮ LIỆU VÀO FILE XML TỪ MYSQL
                                    require_once("ajax/load_xml_from_mysql.php");
                                ?>
                                <script type="text/javascript" src="ajax/live_search.js"></script>
                                <form name="form_timkiem" class="form-wrapper" action="index.php" method="GET">
                                    <div class="timkiemnangcao">tìm kiếm nâng cao</span></div>
                                	<input name="textTimKiem" type="text" onKeyUp="showResult(this.value);" autocomplete="off" id="search" placeholder="nhập tên sản phẩm đồ chơi bạn muốn tìm" required />
                                	<input name="buttonTimKiem" type="submit" value="go" id="submit" />
                                    <div class="clear"></div>
                                    
                                   
                                    <div class="div_timkiemnangcao" style="display:none; position:relative;">
                                      <?php require_once("module/form_tim_kiem_nang_cao.php"); ?>
                                        <img class="close_div_timkiemnangcao" src="skin/img/xclose.png" style="cursor: pointer; position: relative; bottom:0px;" />
                                    </div>    
                                </form>	 
                                <div id="livesearch"  style="width:600px; margin:0px auto; text-align: left; font-family: arial; padding-left:5px;">
                                
                                </div>	