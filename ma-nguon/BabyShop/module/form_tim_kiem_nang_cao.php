<table width="680" height="131" border="0">
  <tr>
    <td width="144"><div align="right">khoảng giá</div></td>
    <td width="29">&nbsp;</td>
    <td width="173">
    <select name="selectGiaTu" id="selectGiaTu">
      <option value="-1"> -- giá từ -- </option>
    	<?php
			for($i = 0; $i<=500000;$i+=20000)
			{
                	echo "<option value='$i'>".number_format($i)."</option>";
			}
		?>
    </select>
              <img style= "margin-left: 38px;" src="skin/img/arrow.png"/> </td>
    <td width="181">
    <select name="selectGiaDen" id="selectGiaDen">
        <option value="-1"> -- đến giá --</option>
        <?php
			for($i = 2000000; $i>0;$i-=100000)
			{
                	echo "<option value='$i'>".number_format($i)."</option>";
			}
		?>
    </select></td>
    <td width="60">&nbsp;</td>
    <td width="67">&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">loại đồ chơi</div></td>
    <td colspan="3"><select style="margin-left:30px; width:200px;" name="selectLoaiDoChoi" id="selectLoaiDoChoi">
    <option value="-1">--chọn loại đồ chơi--</option>
      <?php
			  
                        
                                        
                				  		$sqlstr="select * from loaidochoi";
                						$result=DataProvider::execQuery($sqlstr);
                                        
                                        while($row=mysql_fetch_array($result))
                                        {?>
                          <option value="<?php echo $row[0];?>" <?php echo (isset($flag) && $flag==true && $row[0]==$s_loaidochoi)?'selected':'';?>><?php echo $row[1];?></option>
                                        <?php }
		?>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">nhà sản xuất</div></td>
    <td colspan="3"><select style="margin-left:30px; width:200px;" name="selectNhaSanXuat" id="selectNhaSanXuat">
        <option value="-1">--chọn nhà sản xuất--</option>
      <?php
		
                				  		$sqlstr="select * from nhasanxuat";
                						$result=DataProvider::execQuery($sqlstr);
                                        
                                        while($row=mysql_fetch_array($result))
                                        {?>
                          <option value="<?php echo $row[0];?>" <?php echo (isset($flag) && $flag==true && $row[0]==$s_nhasanxuat)?'selected':'';?>><?php echo $row[1];?></option>
                        
                                        <?php }?>
    
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>