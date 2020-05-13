<?php

    require_once('dbconnection.php');

    // obtem dados do form 
    $v1 = $_POST["input_matricula"];
    $v2 = $_POST["input_total"];
    $v3 = "";
    $v4 = 1;
    $v5 = $_POST["input_parcela_valor"];    //???
    $v6 = $_POST["input_total_3"];      //total de descontos

    $f1 = $_POST["input_dinheiro"];
    $f2 = $_POST["input_debito"];
    $f3 = $_POST["input_credito"];
    $f4 = $_POST["input_deposito"];
    $f5 = $_POST["input_carne"];

    $f2b = $_POST["input_debito_bandeira"];

    $f3b = $_POST["input_credito_bandeira"];
    $f3p = $_POST["input_credito_parcelas"];
    $f3pv = $f3 / $f3p;

    $f5p = $_POST["input_carne_parcelas"];
    $f5pv = $_POST["input_carne_parcelas_valor"];

    // forma de pagamento (p/ tbl_vendas)
    if ($f1 > 0 ) { $v3 = $v3."Din.";}
    if ($f2 > 0 ) { $v3 = $v3."Déb.";}
    if ($f3 > 0 ) { $v3 = $v3."Créd.";}
    if ($f4 > 0 ) { $v3 = $v3."Dep.";}
    if ($f5 > 0 ) { $v3 = $v3."Carnê";}

    //parcelas (caso utilize Crédito parcelado E Carnê, prevalece número de parcelas do Carnê)
    if ($f3 > 0 ) { $v4 = $_POST["input_credito_parcelas"];}
    if ($f5 > 0 ) { $v4 = $_POST["input_carne_parcelas"];}

    session_start();
    $idAux = $_SESSION["SECuserID"]; 

    //forma de pagamento
    
    //salva VENDA 
    $sql = "insert into tbl_vendas (matricula, total, forma_pag, parcelas, id_user, data_venda, desconto, ";
    $sql .= "dinheiro , debito, credito, deposito, carne)";
    $sql .= "values ( $v1, $v2, '$v3', $v4, $idAux, date_add(now(), interval -3 hour), $v6 ,";
    $sql .= "$f1, $f2, $f3, $f4, $f5)";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

    //obtem ID da venda (ultima venda realizada pelo usuário)
    $sql = "select id_venda ";
    $sql .= "from tbl_vendas ";
    $sql .= "where id_user = $idAux ";
    $sql .= "order by id_venda desc limit 1";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        $idAux2 = $row["id_venda"];
    }
    mysqli_free_result($query); 
        
    //atualiza ID da venda (tabela de itens da venda)
    $sql = "update tbl_vendas_itens set ";
    $sql .= "id_venda = $idAux2 ";
    $sql .= "where id_venda = 0 ";
    $sql .= "and id_user = $idAux";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);
    

    //baixa em estoque
    $sql = "select id_produto,quant from tbl_vendas_itens  ";
    $sql .= "where id_venda = $idAux2 ";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
    while($row = $query->fetch_assoc()) {
        baixa_estoque($row["id_produto"],$row["quant"]);
    }
    mysqli_free_result($query); 

    //lança em tabela de movimentação financeira
    
    //Dinheiro
    if ($f1 > 0 ) {
        $sql = "insert into tbl_mov_financ (matricula, tipo, forma_pag, parcela, ";
        $sql .= "vencimento, pagamento, realizado, valor,valor_pago, id_venda, id_user) ";
        $sql .= "values ('$v1','C','Dinheiro', 1, CURDATE(), CURDATE(), 1, $f1, $f1, $idAux2, $idAux)";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        
    }

    // Débito
    if ($f2 > 0 ) {
        $sql = "insert into tbl_mov_financ (matricula, tipo, forma_pag, bandeira, parcela, ";
        $sql .= "vencimento, pagamento, realizado, valor,valor_pago, id_venda, id_user) ";
        $sql .= "values ('$v1','C','Cartão', '$f2b', 1, CURDATE(), CURDATE(), 1, $f2, $f2, $idAux2, $idAux)";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        

        //insere taxa 4% ref. administradora cartão (DESPESA)
        $taxaAdm = $f2 * .04;
        $sql = "insert into tbl_mov_financ (matricula, tipo, forma_pag, bandeira, parcela, ";
        $sql .= "vencimento, pagamento, realizado, valor,valor_pago, id_venda, id_user, obs) ";
        $sql .= "values ('$v1','D','Cartão', '$f2b', 1, CURDATE(), CURDATE(), 1, $taxaAdm, $taxaAdm, $idAux2, $idAux, 'Taxa Administradora Cartão')";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        
    }

    // Crédito
    if ($f3 > 0 ) {
        
        //repete conforme número de parcelas
        $days = 0;
        for ($x = 1; $x <= $f3p; $x++) {
            $days = $days + 30;
            $sql = "insert into tbl_mov_financ (matricula, tipo, forma_pag, bandeira, parcela, ";
            $sql .= "vencimento,pagamento, realizado, valor,valor_pago, id_venda, id_user) ";
            $sql .= "values ('$v1','C','Cartão','$f3b', $x, date_add(now(), interval $days DAY),date_add(now(), interval $days DAY), 1, $f3pv, $f3pv, $idAux2, $idAux)";            
            $Dbobj = new dbconnection(); 
            $query = mysqli_query($Dbobj->getdbconnect(), $sql);
              
        }

        //insere taxa 4% ref. administradora cartão (DESPESA)
        $taxaAdm = $f3 * .04;
        $sql = "insert into tbl_mov_financ (matricula, tipo, forma_pag, bandeira, parcela, ";
        $sql .= "vencimento, pagamento, realizado, valor,valor_pago, id_venda, id_user, obs) ";
        $sql .= "values ('$v1','D','Cartão', '$f3b', 1, date_add(now(), interval 30 DAY), date_add(now(), interval 30 DAY), 1, $taxaAdm, $taxaAdm, $idAux2, $idAux, 'Taxa Administradora Cartão')";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        
    }

    //Depósito
    if ($f4 > 0 ) {
        $sql = "insert into tbl_mov_financ (matricula, tipo, forma_pag, parcela, ";
        $sql .= "vencimento, pagamento, realizado, valor,valor_pago, id_venda, id_user) ";
        $sql .= "values ('$v1','C','Depósito', 1, CURDATE(), CURDATE(), 1, $f4, $f4, $idAux2, $idAux)";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        
    }

    // Carnê
    if ($f5 > 0 ) {
        $days = 0;
        for ($x = 1; $x <= $f5p; $x++) {
            //repete conforme número de parcelas
            $days = $days + 30;
            $sql = "insert into tbl_mov_financ (matricula, tipo, parcela, ";
            $sql .= "vencimento, realizado, valor, id_venda, id_user, iscarne) ";
            $sql .= "values ('$v1','C',$x, date_add(now(), interval $days DAY), 0, $f5pv,  $idAux2, $idAux, 1 )";          
            $Dbobj = new dbconnection(); 
            $query = mysqli_query($Dbobj->getdbconnect(), $sql);
                        
        }

        //insere registro em tabela de vendas-carnês
        $sql = "insert into tbl_vendas_carne (id_venda) values ($idAux2)";          
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
          
    }

    //direciona para página de impressão de carne / ou Listagem
    echo ("<script type='text/javascript'>");
    if ($f5 > 0){
        echo("window.location.href = '/carne.php?v1=$idAux2';");
    } else {
        echo("window.location.href = '/vendas_listagem.php?param=01&param1=0&param2=0';");
    }
    echo ("</script>");

    function baixa_estoque($idAux,$quantAux){

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
    
        //baixa em estoque
        $sql = "update tbl_produtos set ";
        $sql .= "estoque = $estoque_novo ";
        $sql .= "where id_produto = $idAux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        
    }

?>