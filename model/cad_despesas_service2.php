<?php

        require_once('dbconnection.php');

        // obtem dados do form 
        $v1 = $_POST["input_pagam"];
        $v2 = $_POST["input_pago"];
        $v3 = $_POST["input_forma"];

        $id_aux = $_POST["IDhidden"];
        
        //salva 
        $sql = "update tbl_mov_financ set ";
        $sql .= "pagamento = '$v1', ";
        $sql .= "valor_pago = $v2, ";
        $sql .= "forma_pag = '$v3', ";
        $sql .= "realizado = 1 ";
        $sql .= "where id_movimento = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        

        //direciona para página de listagem
        echo ("<script type='text/javascript'>");
        echo("window.location.href = '/cad_despesas_filtro.php';");
        echo ("</script>");

    ?>