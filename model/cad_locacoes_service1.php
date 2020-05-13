<?php

        require_once('dbconnection.php');

        // obtem dados do form 
        $v1 = $_POST["input_quadra"];
        $v2 = $_POST["input_data_loc"];
        $v3 = $_POST["input_ini"];
        $v4 = $_POST["input_fim"];
        $v5 = $_POST["input_total"];
        $v6 = $_POST["input_pago"];
        $v7 = $_POST["input_cli"];
        $v8 = $_POST["input_obs"];

        session_start();
        $IdUser = $_SESSION["SECuserID"];

        $id_aux = $_POST["IDhidden"];
        
        //salva 
        $sql = "update tbl_locacoes set ";
        $sql .= "id_quadra = '$v1', ";
        $sql .= "data_locacao = '$v2', ";
        $sql .= "hora1 = '$v3', ";
        $sql .= "hora2 = '$v4', ";
        $sql .= "valor_total = '$v5', ";
        $sql .= "pago = '$v6', ";
        $sql .= "cliente = '$v7', ";
        $sql .= "obs = '$v8', ";
        $sql .= "id_user = '$IdUser' ";
        $sql .= "where id_loc = '$id_aux' ";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);

        //direciona para página de listagem
        echo ("<script type='text/javascript'>");
        echo ("window.location.href = '/cad_locacoes_listagem.php';");
        echo ("</script>");

    ?>