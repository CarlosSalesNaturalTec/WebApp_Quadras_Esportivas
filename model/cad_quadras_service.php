<?php

        require_once('dbconnection.php');

        // obtem dados do form 
        $v1 = $_POST["input_nome"];  
        $v2 = $_POST["input_desc"];  
        $v3 = $_POST["input_valor1"];  
        $v4 = $_POST["input_valor2"];  

        //salva 
        $sql = "insert into tbl_quadras (nome,descricao,valor_hora_avulsa, valor_hora_mensal ) ";
        $sql .= "values ('$v1','$v2','$v3','$v4')";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        

        //direciona para página de listagem
        echo ("<script type='text/javascript'>");
            echo("window.location.href = '/cad_quadras_listagem.php';");
        echo ("</script>");

    ?>