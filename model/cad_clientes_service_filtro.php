<?php

require_once('dbconnection.php');

$param0 = $_POST["param0"]; //campo à localizar

switch ($param0) {
    case 'nome':
        localiza_nome();
        break;
    case 'matricula':
        localiza_matricula();
        break;
    case 'cpf':
        localiza_cpf();
        break;
    default:
        break;
}

function localiza_nome(){

    $param1 = $_POST["param1"]; // nome do cliente

    $retorno = "0";
    $quant_registros = 0;

    $sql = "select id_cli from tbl_clientes where nome like '$param1%'";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        $retorno = $row["id_cli"];
        $quant_registros = $quant_registros + 1;
    }
    mysqli_free_result($query);

    header('Content-Type: application/json');
    $arr = array('retorno0' => $quant_registros, 'retorno' => $retorno);
    echo json_encode($arr);

}

function localiza_matricula(){

    $param1 = $_POST["param1"]; // matricula

    $retorno = "0";

    $sql = "select id_cli from tbl_clientes where id_cli = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        $retorno = $row["id_cli"];
    }
    mysqli_free_result($query);

    header('Content-Type: application/json');
    $arr = array('retorno' => $retorno);
    echo json_encode($arr);

}

function localiza_cpf(){

    $param1 = $_POST["param1"]; // cpf

    $retorno = "0";

    $sql = "select id_cli from tbl_clientes where cpf = '$param1'";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        $retorno = $row["id_cli"];
    }
    mysqli_free_result($query);

    header('Content-Type: application/json');
    $arr = array('retorno' => $retorno);
    echo json_encode($arr);

}

?>