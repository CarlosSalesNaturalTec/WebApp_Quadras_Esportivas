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
        $v13 = $_POST["input_instagram"];
        $v14 = $_POST["input_obs"];
        $v15 = $_POST["input_numero"];
        
        //salva 
        $sql = "insert into tbl_clientes (nome, nascimento, CPF, rg, ";
        $sql .= "endereco, cep, bairro, cidade, uf,  ";
        $sql .= "contatos, telefone , email,  ";
        $sql .= "instagram, observacoes,numero ) ";
        $sql .= "values ('$v1','$v2','$v3','$v4','$v5','$v6','$v7','$v8','$v9','$v10', ";
        $sql .= "'$v11','$v12','$v13','$v14','$v15' )";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);

        //direciona para página de listagem
        echo ("<script type='text/javascript'>");
        echo("window.location.href = '/cad_clientes_filtro.php';");
        echo ("</script>");

    ?>