
<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
?>

<!DOCTYPE html>
<html>

<head>

    <title>Cadastro de Clientes</title>
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
        <h4><i class="fa fa-user"></i>&nbsp;&nbsp;Cadastro de Clientes</h4>
    </div>
    <br>                

    <div class="w3-container w3-padding-16 w3-border" style="margin-left: 2%; margin-right: 2%">

        <form class="form-horizontal">
            <fieldset>

                <div class="form-group">

                    <div class="col-md-4">
                        <div class="input-group">
                            <input id="input_nome" name="input_nome" 
                                class ="form-control" type="text" placeholder="Pesquisa por Nome" autocomplete="off"/>
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="button" 
                                    onclick="localiza_nome();"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-2">
                        <div class="input-group">
                            <input id="input_mat" name="input_mat" 
                                class ="form-control" type="number" placeholder="Matrícula"/>
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="button"
                                    onclick="localiza_matricula();"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-2"> 
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="CPF" name="input_cpf" id="input_cpf">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="button"
                                    onclick="localiza_cpf();"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-md-2">
                        <button class="w3-btn w3-round w3-border w3-light-blue w3-hover-blue w3-block" 
                            onclick="window.location.href = 'cad_clientes_novo.php';" type="button">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Novo Cliente&nbsp;&nbsp;
                        </button>
                    </div>
                    <div class="col-md-2">
                        <button class="w3-btn w3-round w3-border w3-light-green w3-hover-green w3-block" 
                            onclick="window.location.href = 'cad_clientes_listagem.php?v0=nome&v1=Todos';" type="button">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Listar Todos&nbsp;&nbsp;
                        </button>
                    </div>
                    <div class="col-md-1">
                        <i id="icog" style="display: none" class="fa-2x fa fa-cog fa-spin fa-fw"></i>                    
                    </div>
                </div>
                
            </fieldset>
        </form>

    </div>

    <!-- Scripts Diversos -->
    <script type="text/javascript">

        document.getElementById("input_nome").focus();

        function localiza_nome(){

            var v1 = document.getElementById("input_nome").value;

            var dados = "param0=nome" +
                "&param1=" + v1 ;

            //UI
            UI_start();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/model/cad_clientes_service_filtro.php',
                async: true,
                data: dados,
                success: OnSuccess,
                failure: function (response) {
                    alert("Tente novamente");
                },
                error: function () {
                    alert("Erro! Não foi possível realizar a operação.");
                }
            });

        }

        function OnSuccess(response) {

            var v1 = response.retorno0;
            var v2 = response.retorno;

            UI_stop();

            if (v1 == 0){
                document.getElementById("input_nome").focus();
                alert("Não Localizado !");
                return;
            }

            /*if (v1 == 1){
                var url_temp = "cad_clientes_ficha.php?v1=" + v2;
            } else {
                var url_temp = "cad_clientes_listagem.php?v0=nome&v1=" + document.getElementById("input_nome").value;
            }*/
            var url_temp = "cad_clientes_listagem.php?v0=nome&v1=" + document.getElementById("input_nome").value;

            window.location.href = url_temp;

        }

        function localiza_matricula(){

            var v1 = document.getElementById("input_mat").value;

            var dados = "param0=matricula" +
                        "&param1=" + v1 ;

            //UI
            UI_start();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/model/cad_clientes_service_filtro.php',
                async: true,
                data: dados,
                success: OnSuccess_matricula,
                failure: function (response) {
                    alert("Tente novamente");
                },
                error: function () {
                    alert("Erro! Não foi possível realizar a operação.");
                }
            });

        }

        function OnSuccess_matricula(response) {

            var v2 = response.retorno;

            UI_stop();

            if (v2 == 0){
                document.getElementById("input_mat").focus();
                alert("Não Localizado !");
                return;
            }

            var url_temp = "cad_clientes_ficha.php?v1=" + v2;
            window.location.href = url_temp;

        }

        function localiza_cpf(){

            var v1 = document.getElementById("input_cpf").value;

            var dados = "param0=cpf" +
                        "&param1=" + v1 ;       
            
            //UI
            UI_start();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/model/cad_clientes_service_filtro.php',
                async: true,
                data: dados,
                success: OnSuccess_cpf,
                failure: function (response) {
                    alert("Tente novamente");
                },
                error: function () {
                    alert("Erro! Não foi possível realizar a operação.");
                }
            });

        }

        function OnSuccess_cpf(response) {

            var v2 = response.retorno;

            UI_stop();

            if (v2 == 0){
                document.getElementById("input_cpf").focus();
                alert("Não Localizado !");
                return;
            }

            var url_temp = "cad_clientes_ficha.php?v1=" + v2;
            window.location.href = url_temp;

        }

        function UI_start() {
            // UI
            document.getElementById("icog").style.display = "block";
        }

        function UI_stop() {
            // UI
            document.getElementById("icog").style.display = "none";
        }

    </script>

</body>
</html>