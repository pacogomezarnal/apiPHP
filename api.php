<?php
/*
* Controlador que recibirá las peticiones por GET y que a partir de la petición
* devolverá el json adecuado o bien realizará las acciones apropiadas
*
*/
include "bd.php";
include "jsonResponse.php";

$js=new jsonResponse();
if(isset($_GET["accion"])){
  switch ($_GET["accion"]){
    //mostramos todas las empresas
    case "all":
      $bd=new BD();
      if(!isset($bd->error))
      {
        $empresas=$bd->getEmpresas();
        if(!isset($bd->error)){
          $js->setData($empresas);
          echo $js->json_response();
        }
      }else{
        $msg["error"]="Conexion fallida ".$bd->error;
        $js->setData($msg);
        echo $js->json_response(500);
      }
      break;
    case "new":
      $bd=new BD();
      $bd->insertEmpresa($_GET["nombre"],$_GET["direccion"],$_GET["cp"]);
      $msg["msg"]="Empresa insertada";
      $js->setData($msg);
      echo $js->json_response();
      break;
    default:
      $msg["error"]="accion incorrecta";
      $js->setData($msg);
      echo $js->json_response(404);
  }
}else{
  $msg["error"]="no se ha introducido accion";
  $js->setData($msg);
  echo $js->json_response(404);
}

?>
