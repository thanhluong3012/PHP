<?php
    session_start();
    include('../myclass/clslogin.php');
    $p = new login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form id="form1" name="form1" method="post">
  <table width="600" border="1" align="center">
    <tbody>
      <tr>
        <td colspan="2" align="center">ĐĂNG NHẬP</td>
      </tr>
      <tr>
        <td width="144">Nhập username</td>
        <td width="440"><input type="text" name="txtuser" id="txtuser"></td>
      </tr>
      <tr>
        <td>Nhập password</td>
        <td><input type="password" name="txtpass" id="txtpass"></td>
      </tr>
      <tr align="center">
        <td colspan="2"><input type="submit" name="nut" id="nut" value="Đăng nhập">
        <input type="reset" name="reset" id="reset" value="Reset"></td>
      </tr>
    </tbody>
  </table>
  <?php
    switch($_POST['nut']){
        case 'Đăng nhập':
            {
                $user = $_REQUEST['txtuser'];
                $pass = md5($_REQUEST['txtpass']);
                if($user !='' && $pass !=''){
                    if($p->mylogin($user,$pass,"taikhoang","../admin/admin.php")==0){
                        echo 'Sai username hoặc passworrd';
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


