<?php
/*
* Controlador que recibirá las peticiones por GET y que a partir de la petición
* devolverá el json adecuado o bien realizará las acciones apropiadas
*
*/
include "bd.php";
include "jsonResponse.php";

if(isset($_GET["accion"])){
  $bd=new BD();
  $js=new jsonResponse();
  switch ($_GET["accion"]){
    //mostramos todas las empresas
    case "all":
      $empresas=$bd->getEmpresas();
      if(!isset($bd->error)){
        $js->setData($empresas);
        $js->json_response();
      }
      break;
    case "new":
      $bd->insertEmpresa($_GET["nombre"],$_GET["direccion"],$_GET["cp"]);
      $msg["msg"]="Empresa insertada";
      $js->setData($msg);
      $js->json_response();
      break;
    default:
      $msg["error"]="accion incorrecta";
      $js->setData($msg);
      $js->json_response(404);
  }

}

?>
