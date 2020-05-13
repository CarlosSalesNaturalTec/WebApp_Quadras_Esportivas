<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
?>

<!DOCTYPE html>
<html>

<head>

    <title>Em Construção</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/w3.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <style>
        body {
            background-image: url("images/fundo.jpg");
            background-size:cover;
        }
    </style>

    <!-- Gráfico -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>    


</head>

<body>

    <br>
    <div class="w3-container w3-border w3-round w3-light-gray" style="margin-left: 2%; margin-right: 2%">
        <h4><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Em Construção</h4>
    </div>
   
</body>
</html>