<?php
  include('myclass/clskhachhang.php');
  $p = new khachhang();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div id="container" >
    <div id="banner"></div>
    <div id="main">
      <div id="left">
        <?php
          $p->xemdscongty('select * from cty');
        ?>
      </div>
      <div id="right">
        <?php
          if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0){
            $p->xemdssanpham('select * from sanpham where idcty='.$_REQUEST['id'].'');
          }else{
            $p->xemdssanpham('select * from sanpham');
          }
        ?>
      </div>
    </div>
    <div id="footer"></div>
  </div>
</body>
</html>
