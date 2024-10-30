<?php
    error_reporting(0);
    session_start();
    include('./myclass/clskhachhang.php');
    $p=new khachhang();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div id="banner"></div>
        <div id="main">
        <div align="right"><?php 
            if(isset($_SESSION['id'])){
                $idkh=$_SESSION['id'];
                $tenkh=$p->laycot("select ten from khachhang where iduser='$idkh' limit 1");
            }
            echo "Xin chào: ".$tenkh;
            echo ' | <a href="./logout/index.php">Đăng xuất</a>';
            
        ?>
        </div>
          <form id="form1" name="form1" method="post">
            <?php
                $idsp=$_REQUEST['id'];
                $p->xemchitietsanpham("select * from sanpham where idsp =  $idsp limit 1");
            ?>
            <?php
                if($_POST['nut']=='Thêm vào giỏ hàng'){
                    if(isset($_SESSION['id'])){
                        $idkh=$_SESSION['id'];
                        $ngaydathang=date("Y-m-d");
                        $p->themxoasua("INSERT INTO dathang (idkh, ngaydathang) VALUES ( '$idkh', '$ngaydathang')");
                        {
                            $iddh= $p->laycot("select iddh from dathang where idkh='$idkh' order by iddh desc limit 1");
                            $idsp=$_REQUEST['id'];
                            $soluong = $_REQUEST['txtsoluong'];
                            $dongia = $p->laycot("select gia from sanpham where idsp='$idsp' limit 1 ");
                            $giamgia = $p->laycot("select giamgia from sanpham where idsp='$idsp' limit 1");
                            if($p->themxoasua("INSERT INTO dathang_chitiet (iddh, idsp, soluong, dongia, giamgia) VALUES ('$iddh', '$idsp', '$soluong', '$dongia', '$giamgia')")==1)
                            {
                                echo '<script>
                            alert("Đặt hàng thành công")
                            </script>';

                            }else{
                                echo '<script>
                            alert("Đặt hàng không thành công")
                            </script>';
                            }
                        }
                    }else{
                        echo '<script>
                            alert("Vui lòng đăng nhập")
                            </script>';
    
                        echo '<script>
                            window.location="khachhang/login.php";
                            </script>';
                    }
                }
            ?>
            <hr>

            <?php
                $p->giohang("select ct.idsp, ct.soluong, ct.dongia, ct.giamgia from dathang dh, dathang_chitiet ct where dh.iddh=ct.iddh and dh.idkh='$idkh'");
            ?>
          </form>
        </div>
        <div id="footer"></div>
    </div>
</body>
</html>


