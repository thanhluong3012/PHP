<?php
class tmdt{
    public function connect(){
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
    public function xuatdscty($sql){
        $link =$this->connect();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        if($i>0){
            echo '<table width="581" border="1" align="center">
            <tbody>
              <tr>
                <th width="113" scope="col">STT</th>
                <th width="240" scope="col">Ten Cong Ty</th>
                <th width="240" scope="col">Dia Chi</th>
              </tr>';
              $dem=1;
            while($row = mysqli_fetch_array($ketqua)){
                
                $idcty = $row['idcty'];
                $tencty = $row['tencty'];
                $diachi = $row['diachi'];
                echo '<tr>
                <td align="center">'.$dem.'</td>
                <td align="center">'.$tencty.'</td>
                <td align="center">'.$diachi.'</td>
              </tr>';
              $dem++;
            }
            echo '</tbody>
            </table>';
        }else{
            echo ' khong co du lieu';
        }
    }
	
    public function uploadfile($name, $tmp_name, $folder){
        $name = $folder."/".$name;
        if(move_uploaded_file($tmp_name, $name)){
            return 1;
        }else{
            return 0;
        }
    }

    public function themxoasua($sql){
        $link = $this ->connect();
        if(mysqli_query($link, $sql)){
            return 1;
        }else{
            return 0;
        }
    }

    public function laycot($sql){
        $link =$this->connect();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        $giatri="";
        if($i>0){
            while($row = mysqli_fetch_array($ketqua)){
              $gt=$row[0];
              $giatri=$gt;
            }
        }
        return $giatri;
    }
}
?>