<?php

        require_once('dbconnection.php');

        // obtem dados do form 
        $v1 = $_POST["input_nome"];  
        $v2 = $_POST["input_desc"];  
        $v3 = $_POST["input_valor1"];  
        $v4 = $_POST["input_valor2"];  

        $id_aux = $_POST["IDhidden"];  

        //salva 
        $sql = "update tbl_quadras set  ";
        $sql .= "nome = '$v1', ";
        $sql .= "descricao = '$v2', ";
        $sql .= "valor_hora_avulsa= '$v3', ";
        $sql .= "valor_hora_mensal = '$v4' ";
        $sql .= "where id_quadra='$id_aux'";

        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);

        //direciona para página de listagem
        echo ("<script type='text/javascript'>");
            echo("window.location.href = '/cad_quadras_listagem.php';");
        echo ("</script>");

    ?>