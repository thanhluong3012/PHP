<?php 
	session_start();
  if(isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen'])){
    include('../myclass/clslogin.php');
    $p=new login();
    $p->confirmlogin($_SESSION['id'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['phanquyen']);
  }else{
    header('location:../login/');
  }
?>
<?php 
	include('../myclass/clsquantri.php');
	$p = new quantri();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
	<?php 
		$layid=$_REQUEST['id'];
    $layten=$p->laycot("select tensp from sanpham where idsp='$layid' limit 1");
    $laygia=$p->laycot("select gia from sanpham where idsp='$layid' limit 1");
    $laymota=$p->laycot("select mota from sanpham where idsp='$layid' limit 1");
    $laygiamgia=$p->laycot("select giamgia from sanpham where idsp='$layid' limit 1");
	?>
  <form method="post" enctype="multipart/form-data" name="form1" id="form1">
    <table width="600" border="1" align="center">
      <tbody>
        <tr>
          <td colspan="2" style="text-align: center">QUẢN LÝ SẢN PHẨM</td>
        </tr>
        <tr>
          <td width="209" style="text-align: left">Chọn công ty</td>
          <td width="375" style="text-align: left">
        <?php 
          $layidcty=$p->laycot("select idcty from sanpham where idsp='$layid' limit 1");
          $p-> choncongty("select * from cty", $layidcty);
        ?>
        <input name="txtid" type="hidden" id="txtid" value="<?php echo $layid; ?>"></td>
        </tr>
        <tr>
          <td style="text-align: left">Nhập tên sản phẩm</td>
          <td style="text-align: left"><input type="text" name="txtten" id="txtten" value="<?php echo $layten; ?>"></td>
        </tr>
        <tr>
          <td style="text-align: left">Nhập giá</td>
          <td style="text-align: left"><input type="text" name="txtgia" id="txtgia" value="<?php echo $laygia; ?>"></td>
        </tr>
        <tr>
          <td style="text-align: left">Nhập mô tả</td>
          <td style="text-align: left"><textarea name="txtmota" id="txtmota" ><?php echo $laymota; ?></textarea></td>
        </tr>
        <tr>
          <td style="text-align: left">Hình ảnh</td>
          <td style="text-align: left"><input type="file" name="myfile" id="txtfile"></td>
        </tr>
        <tr>
          <td style="text-align: left">Nhập giảm giá</td>
          <td style="text-align: left"><input type="text" name="txtgiamgia" id="textfield" value="<?php echo $laygiamgia; ?>"></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center"><input type="submit" name="nut" id="nut" value="Thêm">
          <input type="submit" name="nut" id="nut" value="Sửa">
          <input type="submit" name="nut" id="nut" value="Xóa"></td>
        </tr>
      </tbody>
    </table>
    <hr>
	  <?php 
	  	$p->danhsachcongty("select * from sanpham");
	  ?>
  </form>
  <?php 
    switch($_POST['nut'])
    {
      case 'Thêm':
      {
        $name = $_FILES['myfile']['name'];
        $tmp_name = $_FILES['myfile']['tmp_name'];
        $idcty = $_REQUEST['congty'];
        $ten = $_REQUEST['txtten'];
        $gia = $_REQUEST['txtgia'];
        $mota = $_REQUEST['txtmota'];
        $giamgia = $_REQUEST['txtgiamgia'];
        if($name!="")
        {
          $name = time().'_'.$name;
          if($p->uploadfile($name, $tmp_name, "../hinh"))
          {
            if($p->themxoasua("INSERT INTO sanpham (tensp, gia, mota, hinh, giamgia, idcty) VALUES ('$ten','$gia','$mota','$name','$giamgia','$idcty')")==1)
            {
              echo '<script>alert("Thêm sản phẩm thành công")</script>';
            }else{
              echo '<script>alert("Thêm không thành công")</script>';
            }
          }else
          {
            echo '<script>alert("upload không thành công")</script>';
          }
        }else
        {
          echo '<script>alert("Vui lòng chọn file")</script>';
        }
        break;
      }



      case 'Xóa':
      {
        $idxoa=$_REQUEST['txtid'];
        $hinh=$p->laycot("select hinh from sanpham where idsp='$idxoa' limit 1");
        if($idxoa>0){
          if($p->themxoasua("delete from sanpham where idsp='$idxoa' limit 1")==1){
            if(unlink("../hinh/".$hinh)){
              echo '<script>alert("Xóa thành công")</script>';
            }else{
              echo '<script>alert("Xóa hình không thành công")</script>';
            }
          }else{
            echo '<script>alert("Xóa không thành công")</script>';
          }
        }else{
          echo '<script>alert("Chọn sản phẩm cần xóa")</script>';
        }
        break;
      }


      case 'Sửa':
        {
          $idsua=$_REQUEST['txtid'];
          $idcty = $_REQUEST['congty'];
          $ten = $_REQUEST['txtten'];
          $gia = $_REQUEST['txtgia'];
          $mota = $_REQUEST['txtmota'];
          $giamgia = $_REQUEST['txtgiamgia'];
          if($idsua>0){
            if($p->themxoasua("UPDATE sanpham SET tensp = '$ten', gia = '$gia', mota = '$mota', giamgia = '$giamgia', idcty = '$idcty' WHERE idsp = '$idsua' LIMIT 1")==1){
              echo '<script>alert("Sửa thành công")</script>';
            }else{
              echo '<script>alert("Không sửa được")</script>';
            }
          }else{
            echo '<script>alert("Chọn sản phẩm cần sửa")</script>';
          }
          break;
        }
    }
  ?>
</body>
</html>

