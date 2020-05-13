<?php

        require_once('dbconnection.php');

        // obtem dados do form 
        $v2 = $_POST["input_vencim"];
        $v3 = $_POST["input_valor"];
        $v4 = $_POST["input_forma"];
        $v5 = $_POST["input_desc"];
        
        session_start();
        $idAux = $_SESSION["SECuserID"]; 

        // salva despesa. 
        $sql = "insert into tbl_mov_financ ( vencimento , valor , tipo , id_user, forma_pag, obs )";
        $sql .= "values ('$v2','$v3','D', $idAux, '$v4', '$v5')";     
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        
        //direciona para página de listagem
        echo ("<script type='text/javascript'>");
        echo("window.location.href = '/cad_despesas_filtro.php';");
        echo ("</script>");

    ?>