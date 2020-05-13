<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
?>

<!DOCTYPE html>
<html>

<head>

    <title>Ficha de Venda</title>
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
        img {
            max-width:100%;
            height:auto;
        }
    </style>

</head>

<body>

    <br>
    <div class="w3-container w3-border w3-round w3-light-gray w3-small" style="margin-left: 2%; margin-right: 2%">
        <h4><i class="fa fa-shopping-bag"></i>&nbsp;&nbsp;Ficha de Venda 
            <a class="w3-right w3-text-red" href = 'vendas_listagem.php?param=01'>X</a>
        </h4> 
    </div>
    <br>

    <!-- Itens do Pedido  -->
    <div class="w3-container w3-border w3-round" style="margin-left: 2%; margin-right: 2%">    
        <div class="w3-container">
            <br>
            <form class="form-horizontal">
                <fieldset>
                    <div class="form-group">

                        <!-- Cliente -->
                        <div class="form-group">
                            <label for="input_matricula" class="col-md-1 control-label">Matrícula:</label>
                            <div class="col-md-3">
                                <input id="input_matricula" name="input_matricula" value="0"
                                    class ="form-control" type="number" disabled/>    
                            </div>
                            <label for="input_cliente" class="col-md-1 control-label">Cliente:</label>
                            <div class="col-md-6">
                                <input id="input_cliente" name="input_cliente" 
                                class ="form-control" type="text" disabled/>    
                            </div>
                            <div class="col-md-1">
                                <i id="icog2" style="display: none" class="fa-2x fa fa-cog fa-spin fa-fw"></i>           
                            </div>
                        </div>

                        <!-- Totais -->
                        <div class="form-group">
                            <label for="input_total" class="col-md-1 control-label">Total</label>
                            <div class="col-md-3">
                                <input id="input_total" name="input_total" 
                                class ="form-control" type="number" disabled/>    
                            </div>

                            <label for="input_pag" class="col-md-1 control-label">Forma Pag.</label>
                            <div class="col-md-2">
                                <select id="input_pag" name="input_pag" class="form-control" disabled>
                                    <option value="Dinheiro">Dinheiro</option>
                                    <option value="Débito">Débito</option>
                                    <option value="Crédito">Crédito</option>
                                    <option value="Carnê">Carnê</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <input type="hidden" id="IDhidden" name="IDhidden"/>

                </fieldset>
            </form>

        </div> 
    </div>

    <br>

    <!-- Listagem de Itens da Compra -->
    <div class="w3-container w3-border w3-round" style="margin-left: 2%; margin-right: 2%">
        <br>
        <div class="w3-container w3-border w3-padding-16 w3-round w3-light-gray w3-small" 
            style="margin-left: 2%; margin-right: 2%">
        
            <div class="table-responsive">
                <table id='tabela' class='table table-striped table-hover table-bordered'>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quant</th>
                            <th>Valor Unitário</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $id_aux = $_GET["v1"];
                            require_once('model/webservice.php');
                            $ws = new WebService();
                            $ws->vendas_itens_corpo($id_aux);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>

    <!-- Preenche campos -->
    <?php
        $id_aux = $_GET["v1"];
        require_once('model/webservice.php');
        $ws = new WebService();
        $ws->vendas_ficha($id_aux);
    ?> 

</body>
</html>