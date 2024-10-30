<?php 
	include ("clstmdt.php");
	class khachhang extends tmdt{
		public function xemdssanpham($sql){
			$link =$this ->connect();
        	$ketqua = mysqli_query($link, $sql);
        	$i = mysqli_num_rows($ketqua);
			if($i>0)
			{
				while($row=mysqli_fetch_array($ketqua)){
					$idsp = $row['idsp'];
					$tensp= $row['tensp'];
					$gia = $row['gia'];
					$hinh = $row['hinh'];
					echo '<div id="sanpham">
							<div id="sanpham_ten">'.$tensp.'</div>
							<div id="sanpham_hinh"><a href="./chitietsanpham.php?id='.$idsp.'"><img src="./hinh/'.$hinh.'" alt="" width="150px" height="170px"></a></div>
							<div id="sanpham_gia">'.$gia.' USD</div>
						</div>';
				}
			}
			else
			{
				echo 'Đang cập nhật dữ liệu';	
			}
		}

		public function xemdscongty($sql){
			$link =$this ->connect();
        	$ketqua = mysqli_query($link, $sql);
        	$i = mysqli_num_rows($ketqua);
			if($i>0)
			{
				while($row=mysqli_fetch_array($ketqua)){
					$idcty = $row['idcty'];
					$tencty= $row['tencty'];
					echo ' <a href="?id='.$idcty.'">'.$tencty.'</a>';
					echo '<br>';
				}
			}
			else
			{
				echo 'Đang cập nhật dữ liệu';	
			}
		}


		public function xemchitietsanpham($sql){
			$link =$this ->connect();
        	$ketqua = mysqli_query($link, $sql);
        	$i = mysqli_num_rows($ketqua);
			if($i>0)
			{
				echo '<table width="678" border="1" align="center">
					<tbody>';
				while($row=mysqli_fetch_array($ketqua)){
					$idsp = $row['idsp'];
					$tensp= $row['tensp'];
					$mota= $row['mota'];
					$gia = $row['gia'];
					$hinh = $row['hinh'];
					$giamgia = $row['giamgia'];
					$idcty = $row['idcty'];
					$tencty= $this->laycot("select tencty from cty where idcty='$idcty' limit 1");
					echo '<tr>
							<td width="268" rowspan="7" align="center"><img src="hinh/'.$hinh.'" width="200" height="251" alt=""/></td>
							<td width="146">Tên sản phẩm</td>
							<td width="242">'.$tensp.'</td>
						</tr>
						<tr>
							<td>Nhà sản xuất</td>
							<td>'.$tencty.'</td>
						</tr>
						<tr>
							<td height="94">Mô tả</td>
							<td>'.$mota.'</td>
						</tr>
						<tr>
							<td height="24">Giá</td>
							<td>'.$gia.'</td>
						</tr>
						<tr>
							<td height="22">Giảm giá</td>
							<td>'.$giamgia.'</td>
						</tr>
						<tr>
							<td height="30">Số lượng</td>
							<td><input type="text" name="txtsoluong" id="txtsoluong" value="1"></td>
						</tr>
						<tr>
							<td height="27">Đặt hàng</td>
							<td><input type="submit" name="nut" id="nút" value="Thêm vào giỏ hàng"></td>
						</tr>';

				}
				echo ' </tbody>
					</table>';
			}
			else
			{
				echo 'Đang cập nhật dữ liệu';	
			}
		}


		public function giohang($sql){
			$link =$this ->connect();
        	$ketqua = mysqli_query($link, $sql);
        	$i = mysqli_num_rows($ketqua);
			if($i>0)
			{
				echo '<table width="678" border="1" align="center">
					<tbody>
					<tr align="center">
					<td width="75">STT</td>
					<td width="143">TÊN SẢN PHẨM</td>
					<td width="139">SỐ LƯỢNG</td>
					<td width="112">ĐƠN GIÁ</td>
					<td width="97">GIAM GIÁ</td>
				  </tr>';
				$dem=1;
				while($row=mysqli_fetch_array($ketqua)){
					$idsp = $row[0];
					$tensp = $this->laycot("select tensp from sanpham where idsp='$idsp' limit 1");
					$soluong = $row[1];
					$dongia = $row[2];
					$giamgia = $row[3];
					echo '<tr align="center">
					<td>'.$dem.'</td>
					<td>'.$tensp.'</td>
					<td>'.$soluong.'</td>
					<td>'.$dongia.'</td>
					<td>'.$giamgia.'</td>
				  </tr>';
				}
				echo '  </tbody>
						</table>';
			}
			else
			{
				echo 'Đang cập nhật dữ liệu';	
			}
		}
	}
?>

