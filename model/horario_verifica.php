<?php

    require_once('dbconnection.php');

    $param1 = $_POST["param1"]; //data
    $param2 = $_POST["param2"]; //id quadra
    $input_ini = $_POST["param3"]; //hora inicio
    $input_fim = $_POST["param4"]; //hora final

    $retorno = "OK";

    //seleciona todos babas do dia, na quadra.
    $sql = "select TIME_FORMAT(hora1, '%H:%i') as h1, TIME_FORMAT(hora2, '%H:%i') as h2 ";
    $sql .= "from tbl_locacoes ";
    $sql .= "where data_locacao = DATE('$param1') ";
    $sql .= "and (id_quadra = '$param2') ";
    $Dbobj = new dbconnection(); 
    $query = mysqli_query($Dbobj->getdbconnect(), $sql);  

    while($row = $query->fetch_assoc()) {
        $hour_ini = $row["h1"]; //Ex: 19:00
        $hour_fim = $row["h2"]; //Ex: 21:00

        //começa antes MAIS termina durante um baba existente
        if( $input_ini < $hour_ini ) {
            if ($input_fim > $hour_ini ){
                $retorno = "Data ocupada no seguinte horário: ".$hour_ini." às ".$hour_fim;
                break;
            }
        }

        //começa no mesmo horário de baba existente
        if( ($input_ini == $hour_ini) ) {
            $retorno = "Data ocupada no seguinte horário: ".$hour_ini." às ".$hour_fim;
            break;
        }

        //começa durante um baba existente
        if ($input_ini > $hour_ini) {
            if ( $input_fim <= $hour_fim ){
                $retorno = "Data ocupada no seguinte horário: ".$hour_ini." às ".$hour_fim;
                break;
            }  
        }
    }
    mysqli_free_result($query); 

    header('Content-Type: application/json');
    $arr = array('retorno' => $retorno);
    echo json_encode($arr);

?>