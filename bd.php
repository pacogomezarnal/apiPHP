<?php
/**
 *  Base de datos para manejo de la información
 */
class BD
{
  private $host="localhost";
  private $bd="gfct";
  private $user="root";
  private $pw="";
  private $conn;

  //Cadena select all empresas
  private $empresas_all="SELECT * FROM empresa";
  private $empresas_insert="INSERT INTO empresa (nombre, direccion, cp) VALUES (?, ?, ?)";

  //Control de errores
  public $error=null;

  function __construct()
  {
    $this->conn= mysqli_connect($this->host, $this->user, $this->pw, $this->bd);
    if (!$this->conn) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
  }

  function getEmpresas(){
    $empresas=array("empresas"=>array());
    /* Consultas de selección que devuelven un conjunto de resultados */
    if ($result = $this->conn->query($this->empresas_all)) {
        while($empresa = mysqli_fetch_assoc($result)){
          $empresas["empresas"][]=$empresa;
        }
        /* liberar el conjunto de resultados */
        $result->close();
    }else{
        echo $this->error="ERROR en la consulta ".$result;
    }
    return $empresas;
  }
  function insertEmpresa($nombre,$direccion="No introducida",$cp="000000"){

    //Utilizamos sentecias preparadas
    $stmt = $this->conn->prepare($this->empresas_insert);
    $stmt->bind_param("sss",$nombre, $direccion, $cp);
    $stmt->execute();
    $stmt->close();
    $this->conn->close();

  }
  function getEmpresasJSON(){
    $empresas=[];
    /* Consultas de selección que devuelven un conjunto de resultados */
    if ($result = $this->conn->query($this->empresas_all)) {
        while($empresa = mysqli_fetch_assoc($result)){
          $empresas[]=$empresa;
        }
        echo json_encode($empresas);
        /* liberar el conjunto de resultados */
        $result->close();
    }else{
      echo "ERROR en la consulta ".$result ;
    }
  }
}

 ?>
