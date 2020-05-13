<?php

        require_once('dbconnection.php');

        // obtem dados do form 
        $v1 = $_POST["input_nome"];
        $v2 = $_POST["input_nascim"];
        $v3 = $_POST["input_cpf"];
        $v4 = $_POST["input_rg"];
        $v5 = $_POST["input_end"];
        $v6 = $_POST["input_cep"];
        $v7 = $_POST["input_bairro"];
        $v8 = $_POST["input_cidade"];
        $v9 = $_POST["input_uf"];
        $v10 = $_POST["input_contatos"];
        $v11 = $_POST["input_whats"];
        $v12 = $_POST["input_email"];
        $v13 = $_POST["input_obs"];
        $v14 = $_POST["input_instagram"];
        $v15 = $_POST["input_numero"];
        
        $id_aux = $_POST["IDhidden"];
    
        //salva 
        $sql = "update tbl_clientes set ";
        $sql .= "nome = '$v1' ,";
        $sql .= "nascimento  = '$v2', ";
        $sql .= "cpf = '$v3', ";
        $sql .= "rg = '$v4', ";
        $sql .= "endereco = '$v5', ";
        $sql .= "cep = '$v6', ";
        $sql .= "bairro = '$v7', ";
        $sql .= "cidade = '$v8', ";
        $sql .= "uf = '$v9' ,";
        $sql .= "contatos = '$v10' ,";
        $sql .= "telefone = '$v11', ";
        $sql .= "email = '$v12', ";
        $sql .= "observacoes  = '$v13', ";
        $sql .= "instagram = '$v14', ";
        $sql .= "numero = '$v15' ";
        $sql .= "where id_cli = ".$id_aux;
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        

        //direciona para página de filtro
        echo ("<script type='text/javascript'>");
            echo("window.location.href = '/cad_clientes_filtro.php';");
        echo ("</script>");

    ?>