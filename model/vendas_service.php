<?php

require_once('dbconnection.php');

$param0 = $_POST["param0"]; // rotina a executtar
$param1 = $_POST["param1"]; // dado para consulta // id do produto
$param2 = $_POST["param2"]; // quant
$param3 = $_POST["param3"]; // valor unitario
$param4 = $_POST["param4"]; // valor total 

switch ($param0) {
    case 'matricula':
        localiza_matricula($param1);
        break;
    case 'produto':
        localiza_produto($param1);
        break;
    case 'inserir':
        insere_item($param1,$param2,$param3,$param4);
        break;
    case 'cancelar':
        cancelar();
        break;
    default:
        # code...
        break;
}


function localiza_matricula($param1){

    $retorno = "X";
    $retorno2 = "X";

    $sql = "select nome from tbl_clientes where matricula = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        $retorno = $row["nome"];
        $retorno2 = "<img src=\"https://storage.googleapis.com/stadium/".$param1.".jpg\">";
    }
    mysqli_free_result($query);

    header('Content-Type: application/json');
    $arr = array('retorno' => $retorno,'retorno2' => $retorno2);
    echo json_encode($arr);
}

function localiza_produto($param1){

    $retorno = "0";
    $urlAux = "";

    $sql = "select preco,url_imagem from tbl_produtos where id_produto = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        $retorno = $row["preco"];
        $urlAux = $row["url_imagem"];
    }
    mysqli_free_result($query);
    
    header('Content-Type: application/json');
    $arr = array('retorno' => $retorno ,'retorno2' => $urlAux);
    echo json_encode($arr);
}

function insere_item($param1,$param2,$param3,$param4){

    session_start();
    $idAux = $_SESSION["SECuserID"]; 

    //verifica se acompanha entrega
    $entregue = 1;
    $sql = "select acompanha_entrega from tbl_produtos where id_produto = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        if ($row["acompanha_entrega"] == 1) {
            $entregue = 0;
        }
    }
    mysqli_free_result($query);

    $sql = "insert into tbl_vendas_itens (id_user, id_produto, quant, valor_unit, total,entregue ) ";
    $sql .= "values ( $idAux, $param1, $param2, $param3, $param4,$entregue )";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

    header('Content-Type: application/json');
    $arr = array('retorno' => $query);
    echo json_encode($arr);

}

function cancelar(){

    session_start();
    $idAux = $_SESSION["SECuserID"]; 

    $sql = "delete from tbl_vendas_itens ";
    $sql .= "where id_user = $idAux ";
    $sql .= "and id_venda = 0";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

    header('Content-Type: application/json');
    $arr = array('retorno' => $query);
    echo json_encode($arr);

}



?>