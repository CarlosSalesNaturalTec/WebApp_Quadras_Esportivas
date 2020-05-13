<?php

        require_once('dbconnection.php');

        // obtem dados do form 
        $v1 = $_POST["input_fornec"];
        $v2 = $_POST["input_vencim"];
        $v3 = $_POST["input_valor"];
        $v4 = $_POST["input_forma"];
        $v5 = $_POST["input_desc"];

        $id_aux = $_POST["IDhidden"];
        
        //salva 
        $sql = "update tbl_mov_financ set ";
        $sql .= "id_fornec = '$v1', ";
        $sql .= "vencimento = '$v2', ";
        $sql .= "valor = $v3, ";
        $sql .= "forma_pag = '$v4', ";
        $sql .= "obs = '$v5' ";
        $sql .= "where id_movimento = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        

        //direciona para página de listagem
        echo ("<script type='text/javascript'>");
        echo("window.location.href = '/cad_despesas_filtro.php';");
        echo ("</script>");

    ?>