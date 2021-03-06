<?php
/**
 *  Base de datos para manejo de la información
 */
class jsonResponse
{
  private $data;

  function __construct() {}

  public function setData($data){
    $this->data=$data;
  }
  public function json_response($code = 200){
      // borramos headers
      header_remove();
      // set the actual code
      http_response_code($code);
      // formato json
      header('Content-Type: application/json');
      // mostramos el json
      return json_encode($this->data);
  }
}

 ?>
