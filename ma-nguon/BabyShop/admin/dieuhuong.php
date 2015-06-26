<?php
      $page=(isset($_GET['page']))?$_GET['page']:'';
		switch($page)
		{
			case 'dochoi':    require_once("page/dochoi.php"); break; 
            case 'loaidochoi':    require_once("page/loaidochoi.php"); break;       
            case 'nhasanxuat':    require_once("page/nhasanxuat.php"); break;       
       	    case 'doimatkhau':    require_once("page/doimatkhau.php"); break;       
       	   case 'thanhvien':    require_once("page/thanhvien.php"); break; 
            case 'donhang':    require_once("page/donhang.php"); break; 
			default:    require_once("default.php");    break;
		}
?>