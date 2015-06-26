<?php
	mysql_connect(HOST,USER,PASS);
	mysql_query("SET NAMES 'utf8'");
	//select database
	@mysql_select_db(DB) or die( "Unable to select database");
	$myFile = "ajax/xml/links.xml";
	$fh = fopen($myFile, 'w') or die("can't open file");
	$rss_txt='';
	$rss_txt .= '<?xml version="1.0" encoding="utf-8"?>'. PHP_EOL;



$rss_txt .= '<pages>'. PHP_EOL;
    $query = mysql_query("SELECT * FROM dochoi");
    while($values_query = mysql_fetch_assoc($query))
    {
        $rss_txt .= '<link>'. PHP_EOL;

        $rss_txt .= '<title>' .$values_query['TenDoChoi']. '</title>'. PHP_EOL;
        $rss_txt .= '<url>' .'index.php?DenSanPhamTimDuoc='.$values_query['ID']. '</url>'. PHP_EOL;
        $rss_txt .= '</link>'. PHP_EOL;
    }
    
     $query = mysql_query("SELECT * FROM nhasanxuat");
    while($values_query = mysql_fetch_assoc($query))
    {
        $rss_txt .= '<link>'. PHP_EOL;

        $rss_txt .= '<title> nhà sản xuất đồ chơi: ' .$values_query['TenNSX']. '</title>'. PHP_EOL;
        $rss_txt .= '<url>' .'index.php?DenNhaSanXuatTimDuoc='.$values_query['ID']. '</url>'. PHP_EOL;
        $rss_txt .= '</link>'. PHP_EOL;
    }
    
     $query = mysql_query("SELECT * FROM loaidochoi");
    while($values_query = mysql_fetch_assoc($query))
    {
        $rss_txt .= '<link>'. PHP_EOL;

        $rss_txt .= '<title> loại đồ chơi đồ chơi: ' .$values_query['TenLoaiDoChoi']. '</title>'. PHP_EOL;
        $rss_txt .= '<url>' .'index.php?DenLoaiDoChoiTimDuoc='.$values_query['ID']. '</url>'. PHP_EOL;
        $rss_txt .= '</link>'. PHP_EOL;
    }
    
    
$rss_txt .= '</pages>'. PHP_EOL;

fwrite($fh, $rss_txt);
fclose($fh);
	
	
	
?>
