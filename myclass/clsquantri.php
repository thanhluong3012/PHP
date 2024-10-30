
<?php 
 error_reporting(0);
	include('clstmdt.php');
	class quantri extends tmdt{
		 public function choncongty($sql, $idchon){
        	$link =$this->connect();
        	$ketqua = mysqli_query($link, $sql);
        	$i = mysqli_num_rows($ketqua); 
        	if($i>0){
				echo '<select name="congty" id="congty">
            		<option>Mời chọn công ty </option>';
            	while($row = mysqli_fetch_array($ketqua)){
					$idcty = $row['idcty'];
					$tencty = $row['tencty'];
					if($idcty==$idchon){
						echo '<option value="'.$idcty.'" selected>'.$tencty.'</option>';
					}else{
						echo '<option value="'.$idcty.'">'.$tencty.'</option>';
					}
            	}
				echo '</select>';
        	}else{
            	echo ' khong co du lieu';
        	}
    	}
		 public function danhsachcongty($sql){
        	$link =$this->connect();
        	$ketqua = mysqli_query($link, $sql);
        	$i = mysqli_num_rows($ketqua); 
        	if($i>0){
				echo '<table width="600" border="1" align="center">
					  <tbody>
						<tr>
						  <td width="59" style="text-align: center">STT</td>
						  <td width="175" style="text-align: center">TÊN SẢN PHẨM </td>
						  <td width="181" style="text-align: center">MÔ TẢ</td>
						  <td width="74" style="text-align: center">GIÁ</td>
						  <td width="77" style="text-align: center">GIẢM GIÁ</td>
						</tr>';
				$dem=1;
            	while($row = mysqli_fetch_array($ketqua)){
					$idsp = $row['idsp'];
					$tensp = $row['tensp'];
					$gia = $row['gia'];
					$mota = $row['mota'];
					$giamgia = $row['giamgia'];
					echo '<tr>
					  <td style="text-align: center"><a href="?id='.$idsp.'">'.$dem.'</a></td>
					  <td style="text-align: center"><a href="?id='.$idsp.'">'.$tensp.'</a></td>
					  <td style="text-align: center"><a href="?id='.$idsp.'">'.$mota.'</a></td>
					  <td style="text-align: center"><a href="?id='.$idsp.'">'.$gia.'</a></td>
					  <td style="text-align: center"><a href="?id='.$idsp.'">'.$giamgia.'</a></td>
					</tr>';
					$dem++;
            	}
				echo '</tbody>
					</table>';
        	}else{
            	echo ' khong co du lieu';
        	}
    	}
	}
?>