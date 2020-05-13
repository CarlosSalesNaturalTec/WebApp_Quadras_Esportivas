
<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
?>

<!DOCTYPE html>
<html>

<head>

    <title>Cadastro de Despesas - Filtro por Período</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/w3.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

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
        <h4><i class="fa fa-user"></i>&nbsp;&nbsp;Cadastro de Despesas - Filtro por Período</h4>
    </div>
    <br>                

    <div class="w3-container w3-padding-16 w3-border" style="margin-left: 2%; margin-right: 2%">

        <form class="form-horizontal" action="cad_despesas_listagem.php" method="POST">
                <fieldset>

                    <div class="form-group">
                        <label for="input_data1" class="col-md-2 control-label">Despesas com Vencimento entre:</label>
                        <div class="col-md-2">
                            <input id="input_data1" name="input_data1" 
                                class ="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" required/>
                        </div>
                        <label for="input_data2" class="col-md-1 control-label">e:</label>
                        <div class="col-md-2">
                            <input id="input_data2" name="input_data2" 
                                class ="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" required/>
                        </div>
                        <div class="col-md-1">
                            <button class="w3-btn w3-round w3-border w3-light-blue w3-hover-green" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Exibir&nbsp;&nbsp;
                            </button>
                        </div> 
                    </div> 

                    <div class="form-group">
                        <div class="col-md-2">
                            <button class="w3-btn w3-round w3-border w3-light-blue w3-hover-blue w3-block" 
                                onclick="window.location.href = 'cad_despesas_novo.php';" type="button">
                                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Nova Despesa&nbsp;&nbsp;
                            </button>
                        </div>
                        <div class="col-md-1">
                            <i id="icog" style="display: none" class="fa-2x fa fa-cog fa-spin fa-fw"></i>                    
                        </div>
                    </div>

                </fieldset>
            </form>

    </div>

    <script type="text/javascript">
        document.getElementById("input_data1").focus();    
    </script>

</body>
</html>