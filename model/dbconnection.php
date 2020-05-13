<?php

Class dbconnection {

    function getdbconnect(){

        $server = "localhost";
        $user = "root";
        $pwd = "O5hz59mxRX8M";
        $database = "dbstadium";

        $conn = mysqli_connect($server,$user,$pwd,$database) or die("Nao foi possivel conectar ao database");
        $conn->set_charset('utf8mb4');
        return $conn;      
        
    }

}

?>