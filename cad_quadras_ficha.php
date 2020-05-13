<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
?>

<!DOCTYPE html>
<html>

<head>

    <title>Ficha de Quadra</title>
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
        <h4><i class="fa fa-list"></i>&nbsp;&nbsp;Ficha de Quadra</h4>
    </div>
    <br>

    <!-- Cadastro  -->
    <div class="w3-container w3-border w3-round" style="margin-left: 2%; margin-right: 2%">
        <br>
        <form class="form-horizontal" action="model/cad_quadras_service1.php" method="POST">
            <fieldset>
                <div class="form-group">

                    <div class="form-group">
                        <label for="input_nome" class="col-md-2 control-label">Nome:</label>
                        <div class="col-md-6">
                            <input id="input_nome" name="input_nome" 
                                class ="form-control" type="text" maxlength="50" required/>
                        </div>
                        <label for="input_id" class="col-md-1 control-label">Código:</label>
                        <div class="col-md-2">
                            <input id="input_id" name="input_id" 
                                class ="form-control" type="text" disabled/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_desc" class="col-md-2 control-label">Descrição:</label>
                        <div class="col-md-9">
                            <textarea rows="3" id="input_desc" name="input_desc" 
                                class ="form-control" maxlength="512" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_valor1" class="col-md-2 control-label">Valor Hora Avulsa:</label>
                        <div class="col-md-2">
                            <input id="input_valor1" name="input_valor1" 
                                class ="form-control" type="number" value="0" step="any"/>
                        </div>
                        <label for="input_valor2" class="col-md-5 control-label">Valor Hora Mensal:</label>
                        <div class="col-md-2">
                            <input id="input_valor2" name="input_valor2" 
                                class ="form-control" type="number" value="0" step="any"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <p>
                                <button type="button" class="w3-btn w3-round w3-border w3-light-blue w3-hover-red"
                                    onclick="window.location.href = 'cad_quadras_listagem.php';">
                                    <i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Voltar
                                </button>
    
                                <button class="w3-btn w3-round w3-border w3-light-blue w3-hover-green" 
                                    type="submit" id="btsalvar">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Salvar&nbsp;&nbsp;
                                </button>                            
                            </p>
                         </div>  
                    </div>

                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <input id="input_URL" name="input_URL" type="hidden"/>
                        <div id="results" class="col-md-9"></div>  
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
        $ws->cad_quadras_ficha($id_aux);
    ?>

</body>
</html>