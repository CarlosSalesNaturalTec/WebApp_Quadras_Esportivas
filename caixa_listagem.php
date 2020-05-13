<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
    $ws->login_nivel("1");  //liberado para Nivel 1 ou inferior
?>

<!DOCTYPE html>
<html>

<head>

    <title>Caixa</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/w3.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Paginação -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" />

    <style>
        body {
            background-image: url("images/fundo.jpg");
            background-size:cover;
        }
    </style>

</head>

<body>

    <br>
    <div class="w3-container w3-border w3-round w3-light-gray w3-small" style="margin-left: 2%; margin-right: 2%">
        <h4><i class="fa fa-list"></i>&nbsp;&nbsp;Movimento de Caixa - <i id="lbl_periodo"></i></h4>
    </div>
    <br>
    <div class="w3-container w3-border w3-round w3-light-gray w3-small" style="margin-left: 2%; margin-right: 2%">
        <h5><strong>RECEITAS</strong></h5>
        <h5>Total em DINHEIRO : <strong><i id="lbl_total1"></i></strong></h5>
        <h5>CARTÃO: <strong><i id="lbl_total2"></i></strong></h5>
        <h5>OUTROS:<strong><i id="lbl_total3"></i></strong></h5>
        <br>
        <h5><strong>DESPESAS</strong></h5>
        <h5>Total em DINHEIRO : <strong><i id="lbl_total4"></i></strong></h5>
        <h5>CHEQUE: <strong><i id="lbl_total5"></i></strong></h5>
        <h5>CARTÃO: <strong><i id="lbl_total6"></i></strong></h5>
        
    </div>
    <br>
    <!-- Listagem Cadastrados -->
    <div class="w3-container w3-border w3-round w3-padding-16 w3-light-gray w3-small" 
        style="margin-left: 2%; margin-right: 2%">
    
        <div class="table-responsive">
            <table id='tabela' class='table table-striped table-hover table-bordered'>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Matrícula</th>
                        <th>Cliente</th>
                        <th>Fornecedor</th>
                        <th>Obs</th>
                        <th>Forma de Pagamento</th>
                        <th>Bandeira</th>
                        <th>Nº Venda/Carnê</th>
                        <th>Valor</th>
                        <th>Cred/Deb</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                        $param1 = $_POST["input_data1"];
                        $param2 = $_POST["input_data2"];
                        require_once('model/webservice.php');
                        $ws = new WebService();
                        $ws->caixa_corpo($param1,$param2);
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Script Paginação  -->
    <script type="text/javascript" src="scripts/codePaginacao.js"></script>

    <!-- Scripts Diversos -->
    <script type="text/javascript" src="scripts/codeListagem.js"></script>

</body>
</html>