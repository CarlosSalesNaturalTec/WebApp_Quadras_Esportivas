<?php

        require_once('dbconnection.php');

        // obtem dados do form 
        $v1 = $_POST["input_nome"];
        $v2 = $_POST["input_user"];  
        $v3 = $_POST["select_nivel"];  
        $v4 = $_POST["input_pwd"]; 

        $id_aux = $_POST["IDhidden"];
    
        //salva 
        $sql = "update tbl_usuarios set ";
        $sql .= "nome = '$v1' ,";
        $sql .= "usuario = '$v2', ";
        $sql .= "nivel = '$v3', ";
        $sql .= "senha = '$v4' ";
        $sql .= "where id_user = ".$id_aux;
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        

        //direciona para página de listagem
        echo ("<script type='text/javascript'>");
        echo("window.location.href = '/cad_usuarios_listagem.php';");
        echo ("</script>");

    ?>