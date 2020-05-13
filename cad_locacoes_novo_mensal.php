<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
?>

<!DOCTYPE html>
<html>

<head>

    <title>Nova Locação Mensal</title>
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
   
    <!-- Cadastro  -->
    <div class="w3-container w3-border w3-round" style="margin-left: 2%; margin-right: 2%">
        <br>
        <form class="form-horizontal" action="model/cad_locacoes_service_mensal.php" method="POST">
            <fieldset>
                <div class="form-group">
                     <div class="form-group">
                        <div class="col-md-1 w3-center"><i class="fa fa-2x fa-calendar"></i></div>
                        <div class="col-md-8">
                            <h4>NOVA LOCAÇÃO MENSAL</h4>
                        </div>
                    </div>

                    <!-- Quadra / Cliente --> 
                    <div class="form-group">
                        <label for="input_quadra" class="col-md-1 control-label">Quadra:</label>
                        <div class="col-md-2">
                            <select id="input_quadra" name="input_quadra" class ="form-control">
                                <option value="0"></option>
                                <?php
                                    require_once('model/webservice.php');
                                    $ws = new WebService();
                                    echo( $ws->select_quadras());
                                ?>
                            </select>
                        </div>
                        <label for="input_cli" class="col-md-1 control-label">Cliente:</label>
                        <div class="col-md-5">
                            <select id="input_cli" name="input_cli" class ="form-control" 
                                onblur="nomeHidden();">
                                <option value="0"></option>
                                <?php
                                    require_once('model/webservice.php');
                                    $ws = new WebService();
                                    echo( $ws->select_clientes());
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Períodos -->
                    <div class="form-group">
                        <label for="input_data_loc1" class="col-md-1 control-label">Data 1:</label>
                        <div class="col-md-2">
                            <input id="input_data_loc1" name="input_data_loc1" 
                                class ="form-control" type="date"/>
                        </div>
                        <label for="input_ini1" class="col-md-1 control-label">Inicio:</label>
                        <div class="col-md-2">
                            <input id="input_ini1" name="input_ini1" 
                                class ="form-control" type="time" required/>
                        </div>
                        <label for="input_fim1" class="col-md-1 control-label">Término:</label>
                        <div class="col-md-2">
                            <input id="input_fim1" name="input_fim1" 
                                class ="form-control" type="time" onblur="repetir_horarios();" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_data_loc2" class="col-md-1 control-label">Data 2:</label>
                        <div class="col-md-2">
                            <input id="input_data_loc2" name="input_data_loc2" 
                                class ="form-control" type="date" />
                        </div>
                        <label for="input_ini2" class="col-md-1 control-label">Inicio:</label>
                        <div class="col-md-2">
                            <input id="input_ini2" name="input_ini2" 
                                class ="form-control" type="time" required/>
                        </div>
                        <label for="input_fim2" class="col-md-1 control-label">Término:</label>
                        <div class="col-md-2">
                            <input id="input_fim2" name="input_fim2" 
                                class ="form-control" type="time" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_data_loc3" class="col-md-1 control-label">Data 3:</label>
                        <div class="col-md-2">
                            <input id="input_data_loc3" name="input_data_loc3" 
                                class ="form-control" type="date" />
                        </div>
                        <label for="input_ini3" class="col-md-1 control-label">Inicio:</label>
                        <div class="col-md-2">
                            <input id="input_ini3" name="input_ini3" 
                                class ="form-control" type="time" required/>
                        </div>
                        <label for="input_fim3" class="col-md-1 control-label">Término:</label>
                        <div class="col-md-2">
                            <input id="input_fim3" name="input_fim3" 
                                class ="form-control" type="time" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input_data_loc4" class="col-md-1 control-label">Data 4:</label>
                        <div class="col-md-2">
                            <input id="input_data_loc4" name="input_data_loc4" 
                                class ="form-control" type="date" />
                        </div>
                        <label for="input_ini4" class="col-md-1 control-label">Inicio:</label>
                        <div class="col-md-2">
                            <input id="input_ini4" name="input_ini4" 
                                class ="form-control" type="time" required/>
                        </div>
                        <label for="input_fim4" class="col-md-1 control-label">Término:</label>
                        <div class="col-md-2">
                            <input id="input_fim4" name="input_fim4" 
                                class ="form-control" type="time" required/>
                        </div>
                        <div class="col-md-2">
                            <p>
                                <button type="button" class="w3-btn w3-round w3-border w3-light-blue w3-hover-green"
                                 onclick="verificaHorario1();" id="bt_verificahorario1">
                                    <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Verifica Horários
                                </button>                        
                            </p>
                        </div>
                    </div>

                    <!-- Total e Observações -->
                    <div id="frame2" >
                        <!-- TOTAL -->
                        <div class="form-group">
                            <label for="input_total" class="col-md-1 control-label">Valor Total:</label>
                            <div class="col-md-2">
                                <input id="input_total" name="input_total" 
                                    class ="form-control" type="number" required/>
                            </div>  
                            <label for="input_pago" class="col-md-1 control-label">Pago:</label>
                            <div class="col-md-2">
                                <select id="input_pago" name="input_pago" class ="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div> 
                        </div>

                        <!-- OBSERVAÇÕES -->
                        <div class="form-group">
                            <label for="input_obs" class="col-md-1 control-label">Observações:</label>
                            <div class="col-md-8">
                                <input id="input_obs" name="input_obs" 
                                    class ="form-control" type="text" />
                            </div>
                        </div>
                        
                        <!-- Botões -->
                        <div class="form-group">
                            <div class="col-md-1"></div>
                            <div class="col-md-4">
                                <p>
                                    <button type="button" class="w3-btn w3-round w3-border w3-light-blue w3-hover-red"
                                    onclick="window.location.href = 'cad_locacoes_listagem.php';">
                                        <i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Voltar
                                    </button>
        
                                    <button class="w3-btn w3-round w3-border w3-light-green w3-hover-green" 
                                        id="bt_salvar" type="submit" disabled>
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Salvar&nbsp;&nbsp;
                                    </button>                            
                                </p>
                            </div>  
                        </div>
                    </div>

                    <input id="nomehidden" name="nomehidden" class ="form-control" type="hidden"/>

                </div>

            </fieldset>
        </form>

    </div> 

    <script type="text/javascript">

        document.getElementById("input_quadra").focus();

        function verificaHorario1() {

            var v1 = document.getElementById("input_data_loc1").value;
            var v2 = document.getElementById("input_quadra").value;
            var v3 = document.getElementById("input_ini1").value;  
            var v4 = document.getElementById("input_fim1").value;        

            var dados = "param1=" + v1 +
                        "&param2=" + v2 +
                        "&param3=" + v3 +
                        "&param4=" + v4 ;

            document.getElementById("bt_verificahorario1").style.cursor = "progress";
            document.getElementById("bt_verificahorario1").disabled = true;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/model/horario_verifica.php',
                async: true,
                data: dados,
                success: OnSuccess1,
                failure: function (response) {
                    alert("Falha. Tente novamente");
                    return false
                },
                error: function () {
                    alert("Erro ao conectar com banco de dados");
                    return false
                }
            });

        }

        function OnSuccess1(response) {

            var v1 = response.retorno;

            if (v1 != "OK"){
                document.getElementById("bt_verificahorario1").disabled = false;
                document.getElementById("bt_salvar").disabled = true;
                alert(v1);
                alert("Data 1");
            } else{
                verificaHorario2();  
            }

        }

        function verificaHorario2() {

            var v1 = document.getElementById("input_data_loc2").value;
            var v2 = document.getElementById("input_quadra").value;
            var v3 = document.getElementById("input_ini2").value;  
            var v4 = document.getElementById("input_fim2").value;        

            var dados = "param1=" + v1 +
                        "&param2=" + v2 +
                        "&param3=" + v3 +
                        "&param4=" + v4 ;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/model/horario_verifica.php',
                async: true,
                data: dados,
                success: OnSuccess2,
                failure: function (response) {
                    alert("Falha. Tente novamente");
                    return false
                },
                error: function () {
                    alert("Erro ao conectar com banco de dados");
                    return false
                }
            });

        }

        function OnSuccess2(response) {

            var v1 = response.retorno;

            if (v1 != "OK"){
                document.getElementById("bt_verificahorario1").disabled = false;
                document.getElementById("bt_salvar").disabled = true;
                alert(v1);
                alert("Data 2");
            } else{
                verificaHorario3();  
            }         

        }

        function verificaHorario3() {

            var v1 = document.getElementById("input_data_loc3").value;
            var v2 = document.getElementById("input_quadra").value;
            var v3 = document.getElementById("input_ini3").value;  
            var v4 = document.getElementById("input_fim3").value;        

            var dados = "param1=" + v1 +
                        "&param2=" + v2 +
                        "&param3=" + v3 +
                        "&param4=" + v4 ;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/model/horario_verifica.php',
                async: true,
                data: dados,
                success: OnSuccess3,
                failure: function (response) {
                    alert("Falha. Tente novamente");
                    return false
                },
                error: function () {
                    alert("Erro ao conectar com banco de dados");
                    return false
                }
            });

        }

        function OnSuccess3(response) {

            var v1 = response.retorno;

            if (v1 != "OK"){
                document.getElementById("bt_verificahorario1").disabled = false;
                document.getElementById("bt_salvar").disabled = true;
                alert(v1);
                alert("Data 3");
            } else{
                verificaHorario4();  
            }           

        }

        function verificaHorario4() {

            var v1 = document.getElementById("input_data_loc4").value;
            var v2 = document.getElementById("input_quadra").value;
            var v3 = document.getElementById("input_ini4").value;  
            var v4 = document.getElementById("input_fim4").value;        

            var dados = "param1=" + v1 +
                        "&param2=" + v2 +
                        "&param3=" + v3 +
                        "&param4=" + v4 ;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/model/horario_verifica.php',
                async: true,
                data: dados,
                success: OnSuccess4,
                failure: function (response) {
                    alert("Falha. Tente novamente");
                    return false
                },
                error: function () {
                    alert("Erro ao conectar com banco de dados");
                    return false
                }
            });

        }

        function OnSuccess4(response) {

            document.getElementById("bt_verificahorario1").style.cursor = "default";
            document.getElementById("bt_verificahorario1").disabled = false;

            var v1 = response.retorno;

            if (v1 != "OK"){
                document.getElementById("bt_verificahorario1").disabled = false;
                document.getElementById("bt_salvar").disabled = true;
                alert(v1);
                alert("Data 4");
            } else{
                //libera botão Salvar
                document.getElementById("bt_salvar").disabled = false;
            }           

        }

        function repetir_horarios(){
            //repete horários nas datas seguintes
            var h1 = document.getElementById("input_ini1").value;
            var h2 = document.getElementById("input_fim1").value;
            document.getElementById("input_ini2").value = h1;
            document.getElementById("input_fim2").value = h2;
            document.getElementById("input_ini3").value = h1;
            document.getElementById("input_fim3").value = h2;
            document.getElementById("input_ini4").value = h1;
            document.getElementById("input_fim4").value = h2;
        }

        function nomeHidden(){
            var e = document.getElementById("input_cli");
            document.getElementById("nomehidden").value = e.options[e.selectedIndex].text;
        }
            
    </script>    

</body>
</html>