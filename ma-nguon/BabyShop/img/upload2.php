
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>upload</title>
<link rel="stylesheet" type="text/css" href="../skin/css/upload.css" />

<script type="text/javascript">
	function goBack(s)
	{
			opener.form_nhasanxuat.textHinhAnh.value=s;
			window.close();
	}
</script>
</head>

<body>

<?php
	if(isset($_POST['buttonUpload']))
	{
		if($_FILES["file"]["size"]<500000
		&&(($_FILES["file"]["type"]=="image/pjpeg")||($_FILES["file"]["type"]=="image/jpeg")|| ($_FILES["file"]["type"]=="image/png") ||($_FILES["file"]["type"]=="image/gif")))
		{
			if($_FILES['file']['error']>0) //lỗi ngoại lệ
			{
				echo("Return Code: ".$_FILES['file']['error']."<br />");
			}
			else //không có lỗi
			{
				
				/*xuất ra thông tin của file*/
				//echo "<br>vùng tạm lưu trữ file đã upload lên: " . $_FILES["file"]["tmp_name"];
				echo "<br>file tải lên: " . $_FILES["file"]["name"];
				echo "<br>loại tập tin: " . $_FILES["file"]["type"];
				echo "<br>Kích thước: " . ($_FILES["file"]["size"])/1024 ."Kb <br />";
				
				$targetDir="nha-san-xuat/";
				$relativePath=$targetDir.$_FILES["file"]["name"];
				$doitenfile=$_FILES["file"]["name"];
				if(file_exists($relativePath)) //ĐỔI TÊN FILE UPLOAD nếu file upload này trùng với 1 file trong thư viện
				{		
					//5 ký tự ngẫu nhiên_ + tên file			
					$doitenfile=substr(md5(rand(1000,9999)),0,5)."_".$_FILES["file"]["name"];
				}
				//UPLOAD KHÔNG CẦN ĐỔI TÊN nếu file Up lên không trùng tên với file nào có trong thư viện ảnh
				move_uploaded_file($_FILES["file"]["tmp_name"], "nha-san-xuat/" .$doitenfile); 
				$relativePath=$targetDir.$doitenfile;
				//xuất link cho phép điền đường dẫn vào textbox đường dẫn ở DoChoi.php
				echo "<a href='#' onclick='goBack(\"".$relativePath."\");' ><div class='chonanhnay'>chọn ảnh này</div></a>";
			}
		}
		else //lỗi
		{
			echo("<b>lỗi Upload: </b>phải là file ảnh (jpg,gif,png) và kích thước dưới 500kb");	
			?>
			<input type="button" value="Thử lần nữa" onClick="document.location.reload(true)">
			
			<?php
		}
	}
	else
	{

?>
<form action="upload2.php" method="post" enctype="multipart/form-data" name="upload" id="upload">
  <table width="312" height="153" border="0" align="center">
    <tr>
      <td width="64">chọn hình</td>
      <td width="238"><input type="file" name="file" id="file" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="buttonUpload" id="buttonUpload" value="Upload" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>hỗ trợ định dạng (jpg,png,gif)</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>kích thước tối đa: 500kb</td>
    </tr>
  </table>
</form>
<?php
	}
?>
</body>
</html>