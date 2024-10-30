<?php
    class login
    {
        public function connectlogin(){
            $con = mysqli_connect("localhost", "root", "","tmdt_db");
            if(!$con)
            {
                echo 'Khong ket noi duoc';
                exit();
            }
            else
            {
                return $con;
            }
        }

        public function mylogin($user, $pass, $table, $header){
            $sql="SELECT iduser, username, password, phanquyen FROM $table WHERE username = '$user' and password = '$pass' limit 1;";
            $link =$this->connectlogin();
        	$ketqua = mysqli_query($link, $sql);
        	$i = mysqli_num_rows($ketqua); 
            if($i==1){
                while($row=mysqli_fetch_array($ketqua)){
                    $id=$row['iduser'];
                    $myuser=$row['username'];
                    $mypass=$row['password'];
                    $phanquyen=$row['phanquyen'];

                    session_start();
                    $_SESSION['id']=$id;
                    $_SESSION['user']=$myuser;
                    $_SESSION['pass']=$mypass;
                    $_SESSION['phanquyen']=$phanquyen;
                    header('Location:'.$header);
                }
            }else{
                return 0;
            }
        }

        public function confirmlogin($id, $user, $pass, $phanquyen){
            $sql = "SELECT iduser, username, password, phanquyen FROM taikhoang  where iduser='$id' and username='$user' and password='$pass' and phanquyen='$phanquyen' limit 1 ";
            $link =$this->connectlogin();
        	$ketqua = mysqli_query($link, $sql);
        	$i = mysqli_num_rows($ketqua);
            if($i!=1){
                header('location:../login/');
            }
        }
    }

?>