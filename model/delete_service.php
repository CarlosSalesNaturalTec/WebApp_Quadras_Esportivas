<?php

require_once('dbconnection.php');

$param0 = $_POST["param0"];

switch ($param0) {
    case 'cad_usuarios_apagar':
        cad_usuarios_apagar();
        break;
    case 'cad_clientes_apagar':
        cad_clientes_apagar();
        break;
    case 'cad_quadras_apagar':
        cad_quadras_apagar();
        break;
    case 'vendas_apagar':
        vendas_apagar();
        break;
    case 'cad_fornecedores_apagar':
        cad_fornecedores_apagar();
        break;
    case 'reposicoes_apagar':
        reposicoes_apagar();
        break;
    case 'reposicoes_item_apagar':
        reposicoes_item_apagar();
        break;
    case 'cad_despesas_apagar':
        cad_despesas_apagar();
        break;
    case 'saidas_apagar':
        saidas_apagar();
        break;
    case 'carnes_apagar':
        carnes_apagar();
        break;
    case 'cad_locacoes_apagar':
        cad_locacoes_apagar();
        break;
    default: 
        break;
}

function cad_usuarios_apagar(){

    $param1 = $_POST["param1"];

    $sql = "delete from tbl_usuarios where id_user = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

}

function cad_clientes_apagar(){

    $param1 = $_POST["param1"];

    $sql = "delete from tbl_clientes where id_cli = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

}

function cad_quadras_apagar(){

    $param1 = $_POST["param1"];

    $sql = "delete from tbl_quadras where id_quadra = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

}

function vendas_apagar(){

    $param1 = $_POST["param1"];

    //estorno em estoque
    $sql = "select id_produto,quant from tbl_vendas_itens  ";
    $sql .= "where id_venda = $param1 ";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        estorno($row["id_produto"],$row["quant"]);
    }
    mysqli_free_result($query); 

    //vendas
    $sql = "delete from tbl_vendas where id_venda = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

    //itens da venda
    $sql = "delete from tbl_vendas_itens where id_venda = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

    //movimentação financeira
    $sql = "delete from tbl_mov_financ where id_venda = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    


}

function estorno($idAux,$quantAux){

    //estoque atual
    $estoque_atual = 0;
    $sql = "select estoque from tbl_produtos ";
    $sql .= "where id_produto = $idAux ";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        $estoque_atual = $row["estoque"];
    }
    mysqli_free_result($query); 

    $estoque_novo = $estoque_atual + $quantAux;

    //baixa em estoque
    $sql = "update tbl_produtos set ";
    $sql .= "estoque = $estoque_novo ";
    $sql .= "where id_produto = $idAux";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    
}

function cad_fornecedores_apagar(){
    $param1 = $_POST["param1"];

    $sql = "delete from tbl_fornec where id_fornec = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    
}

function reposicoes_apagar(){
    
    $param1 = $_POST["param1"];

    //apaga nota
    $sql = "delete from tbl_notas where id_nota = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

    //-------------------------------------------------------

    //estorno em estoque
    $sql = "select id_produto, quant from tbl_notas_itens  ";
    $sql .= "where id_nota = $param1 ";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        reposicoes_estorno($row["id_produto"],$row["quant"]);
    }
    mysqli_free_result($query); 

    //-------------------------------------------------------

    //apaga itens da nota
    $sql = "delete from tbl_notas_itens where id_nota = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

}

function reposicoes_item_apagar(){
    
    $param1 = $_POST["param1"];

    $sql = "delete from tbl_notas_itens where id_item = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

    header('Content-Type: application/json');
    $arr = array('retorno' => $query);
    echo json_encode($arr);

}

function reposicoes_estorno($idAux, $quantAux){

    //estoque atual
    $estoque_atual = 0;
    $sql = "select estoque from tbl_produtos ";
    $sql .= "where id_produto = $idAux ";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        $estoque_atual = $row["estoque"];
    }
    mysqli_free_result($query); 

    $estoque_novo = $estoque_atual - $quantAux;

    //estorno em estoque
    $sql = "update tbl_produtos set ";
    $sql .= "estoque = $estoque_novo ";
    $sql .= "where id_produto = $idAux";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    
}

function cad_despesas_apagar(){
    
    $param1 = $_POST["param1"];

    $sql = "delete from tbl_mov_financ where id_movimento = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    
}

function saidas_apagar(){
    
    $param1 = $_POST["param1"];

    //estorno em estoque
    $sql = "select id_produto,quant from tbl_saidas ";
    $sql .= "where id_saida = $param1 ";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        estorno($row["id_produto"],$row["quant"]);
    }
    mysqli_free_result($query); 

    $sql = "delete from tbl_saidas where id_saida = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    
}

function carnes_apagar(){
    
    $param1 = $_POST["param1"];

    $sql = "delete from tbl_mov_financ where id_movimento = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    
}

function cad_locacoes_apagar(){

    $param1 = $_POST["param1"];

    $sql = "delete from tbl_locacoes where id_loc = $param1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

}

?>