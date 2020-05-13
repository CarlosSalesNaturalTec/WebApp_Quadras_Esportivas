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
        
        //salva 
        $sql = "insert into tbl_locacoes ";
        $sql .= "(id_quadra, data_locacao, hora1, hora2, ";
        $sql .= "valor_total, pago, cliente, obs, tipo, id_user ) ";
        $sql .= "values ('$v1','$v2','$v3','$v4','$v5','$v6','$v7','$v8','Avulso', '$IdUser' )";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);

        //direciona para página de listagem
        echo ("<script type='text/javascript'>");
        echo ("window.location.href = '/cad_locacoes_listagem.php';");
        echo ("</script>");

    ?>