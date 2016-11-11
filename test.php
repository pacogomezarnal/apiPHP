<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Probando API</title>
  </head>
  <body>
    <?php
    include "bd.php";

    $bd=new BD();
    $bd->insertEmpresa("Pedro");
     ?>
  </body>
</html>
