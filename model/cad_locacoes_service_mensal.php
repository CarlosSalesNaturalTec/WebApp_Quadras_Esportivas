<?php

        require_once('dbconnection.php');

        // obtem dados do form 
        $v1 = $_POST["input_data_loc1"];
        $v2 = $_POST["input_data_loc2"];
        $v3 = $_POST["input_data_loc3"];
        $v4 = $_POST["input_data_loc4"];
        $v5 = $_POST["input_quadra"];
        $v6 = $_POST["input_ini1"];
        $v7 = $_POST["input_fim1"];
        $v8 = $_POST["input_total"];
        $v9 = $_POST["input_pago"];
        $v10 = $_POST["input_cli"];
        $v11 = $_POST["input_obs"];

        $v12 = $_POST["input_ini2"];
        $v13 = $_POST["input_fim2"];
        $v14 = $_POST["input_ini3"];
        $v15 = $_POST["input_fim3"];
        $v16 = $_POST["input_ini4"];
        $v17 = $_POST["input_fim4"];
        $v17 = $_POST["input_fim4"];
        $v18 = $_POST["nomehidden"];

        session_start();
        $IdUser = $_SESSION["SECuserID"];
        
        //salva Data1
        $sql = "insert into tbl_locacoes ";
        $sql .= "(data_locacao, id_quadra, hora1, hora2, ";
        $sql .= "valor_total, pago, id_cli, obs, tipo, id_user, cliente ) ";
        $sql .= "values ('$v1','$v5','$v6','$v7','$v8','$v9','$v10','$v11','Mensal', '$IdUser', '$v18' )";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        
        //salva Data2
        $sql = "insert into tbl_locacoes ";
        $sql .= "(data_locacao, id_quadra, hora1, hora2, ";
        $sql .= "valor_total, pago, id_cli, obs, tipo, id_user, cliente ) ";
        $sql .= "values ('$v2','$v5','$v12','$v13','$v8','$v9','$v10','$v11','Mensal', '$IdUser', '$v18' )";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);

        //salva Data3
        $sql = "insert into tbl_locacoes ";
        $sql .= "(data_locacao, id_quadra, hora1, hora2, ";
        $sql .= "valor_total, pago, id_cli, obs, tipo, id_user, cliente ) ";
        $sql .= "values ('$v3','$v5','$v14','$v15','$v8','$v9','$v10','$v11','Mensal', '$IdUser', '$v18' )";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);

        //salva Data4
        $sql = "insert into tbl_locacoes ";
        $sql .= "(data_locacao, id_quadra, hora1, hora2, ";
        $sql .= "valor_total, pago, id_cli, obs, tipo, id_user, cliente ) ";
        $sql .= "values ('$v4','$v5','$v16','$v17','$v8','$v9','$v10','$v11','Mensal', '$IdUser', '$v18' )";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);

        //direciona para página de listagem
        echo ("<script type='text/javascript'>");
        echo ("window.location.href = '/cad_locacoes_listagem.php';");
        echo ("</script>");

    ?>