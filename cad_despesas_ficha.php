<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
?>

<!DOCTYPE html>
<html>

<head>

    <title>Ficha de Despesa</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/w3.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

     <style type="text/css">
        body {
            background-image: url("images/fundo.jpg");
            background-size:cover;
        }
    </style>

</head>

<body>

    <br>
    <div class="w3-container w3-border w3-round w3-light-gray w3-small" style="margin-left: 2%; margin-right: 2%">
        <h4><i class="fa fa-dollar"></i>&nbsp;&nbsp;Ficha de Despesa</h4>
    </div>
    <br>

    <!-- Cadastro  -->
    <div class="w3-container w3-border w3-round" style="margin-left: 2%; margin-right: 2%">
        <br>
        <form class="form-horizontal" action="model/cad_despesas_service1.php" method="POST">
            <fieldset>
                <div class="form-group">

                    <div class="form-group">
                        <label for="input_fornec" class="col-md-1 control-label">Fornecedor:</label>
                        <div class="col-md-5">
                            <select class="form-control" id="input_fornec" name="input_fornec">
                                <option value=""></option>
                                <?php
                                    require_once('model/webservice.php');
                                    $ws = new WebService();
                                    $ws->select_fornecedores();
                                ?>
                            </select>
                        </div>                       
                    </div>

                    <div class="form-group">
                        <label for="input_vencim" class="col-md-1 control-label">Vencimento:</label>
                        <div class="col-md-2">
                            <input id="input_vencim" name="input_vencim" 
                                class ="form-control" type="date" required/>
                        </div>
                        <label for="input_valor" class="col-md-1 control-label">Valor:</label>
                        <div class="col-md-2">
                            <input id="input_valor" name="input_valor" 
                            class ="form-control" type="number" step="any"
                            onfocus="document.getElementById('input_valor').select();" required/>    
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_forma" class="col-md-1 control-label">Forma de Pagamento:</label>
                        <div class="col-md-2">
                            <select id="input_forma" name="input_forma" class="form-control" >
                                <option value=""></option>
                                <option value="Dinheiro">Dinheiro</option>
                                <option value="Cartão">Cartão</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_desc" class="col-md-1 control-label">Descrição:</label>
                        <div class="col-md-5">
                            <input id="input_desc" name="input_desc" 
                                class ="form-control" type="text" />   
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-8">
                            <p>
                                <button type="button" class="w3-btn w3-round w3-border w3-light-blue w3-hover-red"
                                    onclick="window.location.href = 'cad_despesas_filtro.php';">
                                    <i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Voltar
                                </button>
    
                                <button class="w3-btn w3-round w3-border w3-light-blue w3-hover-green" 
                                    type="submit" id="btsalvar">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Salvar&nbsp;&nbsp;
                                </button>                            
                            </p>
                         </div>  
                    </div>

                </div>

                <input type="hidden" id="IDhidden" name="IDhidden"/>

            </fieldset>
        </form>

    </div> 

    <!-- Preenche campos -->
    <?php
        $id_aux = $_GET["v1"];
        require_once('model/webservice.php');
        $ws = new WebService();
        $ws->cad_despesas_ficha($id_aux);
    ?> 

    <script type="text/javascript">
        document.getElementById("input_fornec").focus();
    </script>

</body>
</html>