<?php

        require_once('dbconnection.php');

        // obtem dados do form 
        $v1 = $_POST["input_nome"];  
        $v2 = $_POST["input_user"];  
        $v3 = $_POST["select_nivel"];  
        $v4 = $_POST["input_pwd"];  

        //salva 
        $sql = "insert into tbl_usuarios (nome,usuario,nivel,senha ) ";
        $sql .= "values ('$v1','$v2','$v3','$v4')";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        

        //direciona para página de listagem
        echo ("<script type='text/javascript'>");
            echo("window.location.href = '/cad_usuarios_listagem.php';");
        echo ("</script>");

    ?>