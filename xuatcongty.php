<?php
include("myclass/clstmdt.php");
$p = new tmdt();
?>

</table> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $p->xuatdscty("select * from cty");
    ?>
</body>
</html>
