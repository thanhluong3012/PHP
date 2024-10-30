<?php
  session_start();
  include('../myclass/clslogin.php');
  $p=new login();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post">
  <table width="600" border="1" align="center">
    <tbody>
      <tr>
        <td colspan="2" align="center">ĐĂNG NHẬP</td>
      </tr>
      <tr>
        <td width="159">Nhập email khách hàng</td>
        <td width="425"><input type="text" name="txtemail" id="txtemail"></td>
      </tr>
      <tr>
        <td>Nhập mật khẩu</td>
        <td><input type="password" name="txtpass" id="txtpass"></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="nut" id="nut" value="Đăng nhập">
        <input type="reset" name="reset" id="reset" value="Reset"></td>
      </tr>
    </tbody>
  </table>

  <?php
    switch($_POST['nut'])
    {
      case 'Đăng nhập':
        {
          $user=$_REQUEST['txtemail'];
          $pass=md5($_REQUEST['txtpass']);
          if($user !='' && $pass !=''){
            if($p->mylogin($user, $pass, "khachhang", "../")==0){
              echo 'Sai eamil hoặc mật khẩu';
            }
          }else{
            echo 'Vui lòng nhập đầy đủ thông tin';
          }
          break;
        }
    }

  ?>
</form>
</body>
</html>