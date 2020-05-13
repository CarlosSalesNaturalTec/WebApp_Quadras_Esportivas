<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('dbconnection.php');

$param0 = $_POST["param0"]; //user
$param1 = $_POST["param1"]; //pwd

$Identificador_msg = "0";

$sql = "select id_user, senha, nome, nivel from tbl_usuarios where usuario = '$param0'";
$Dbobj = new dbconnection(); 
$query = mysqli_query($Dbobj->getdbconnect(), $sql);  
while($row = $query->fetch_assoc()) {
    if ( $param1 == $row["senha"] ) 
    {
        session_start();
        $_SESSION["SECusername"] = $row["nome"];
        $_SESSION["SECuserlevel"] = $row["nivel"];
        $_SESSION["SECuserID"] = $row["id_user"];
        $Identificador_msg = "painel.php";
    }
    else 
    {
        $Identificador_msg = "2";
    }
}
mysqli_free_result($query);

header('Content-Type: application/json');
$arr = array('retorno' => $Identificador_msg);
echo json_encode($arr);

?>