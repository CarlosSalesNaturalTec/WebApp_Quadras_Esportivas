<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
?>

<!DOCTYPE html>
<html>

<head>

    <title>Ficha de Locação</title>
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
        <form class="form-horizontal" action="model/cad_locacoes_service1.php" method="POST" name="myForm" 
            onsubmit="return validateForm()">
            <fieldset>
                <div class="form-group">
                     <div class="form-group">
                        <div class="col-md-1 w3-center"><i class="fa fa-2x fa-calendar"></i></div>
                        <div class="col-md-8">
                            <h4>Ficha de Locação</h4>
                        </div>
                    </div>

                    <!-- Quadra e Data --> 
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
                        <label for="input_data_loc" class="col-md-1 control-label">Data:</label>
                        <div class="col-md-2">
                            <input id="input_data_loc" name="input_data_loc" 
                                class ="form-control" type="date" value="<?php echo date('Y-m-d'); ?>"/>
                        </div>
                        
                    </div>

                    <!-- Período -->
                    <div class="form-group">
                        <label for="input_ini" class="col-md-1 control-label">Inicio:</label>
                        <div class="col-md-2">
                            <input id="input_ini" name="input_ini" 
                                class ="form-control" type="time" required/>
                        </div>
                        <label for="input_fim" class="col-md-1 control-label">Término:</label>
                        <div class="col-md-2">
                            <input id="input_fim" name="input_fim" 
                                class ="form-control" type="time" required/>
                        </div>
                        <div class="col-md-1">
                            <p>
                                <button type="button" class="w3-btn w3-round w3-border w3-light-blue w3-hover-green"
                                 onclick="verificaHorario();" id="bt_verificahorario">
                                    <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Verificar Horário
                                </button>                        
                            </p>
                         </div>  
                    </div>

                    <!-- Total -->
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

                    <div class="form-group">
                        <label for="input_cli" class="col-md-1 control-label">Cliente:</label>
                        <div class="col-md-5">
                            <input id="input_cli" name="input_cli" 
                                class ="form-control" type="text" maxlenth="50"/>
                        </div>
                    </div>

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

                <input type="hidden" id="IDhidden" name="IDhidden"/>

            </fieldset>
        </form>

    </div> 

    <!-- Preenche campos -->
    <?php
        $id_aux = $_GET["v1"];
        require_once('model/webservice.php');
        $ws = new WebService();
        $ws->cad_locacoes_ficha($id_aux);
    ?>

    <script type="text/javascript">

        document.getElementById("input_quadra").focus();

        function validateForm() { 

            //caso PAGO , deve-se informar cliente
            var x = document.forms["myForm"]["input_pago"].value;
            if (x == "1") {

                x = document.forms["myForm"]["input_cli"].value;
                if (x == ""){
                    alert("Informe Cliente");
                    document.getElementById("input_cli").focus();
                    return false;
                }
            }

        }

        function verificaHorario() {

            var v1 = document.getElementById("input_data_loc").value;
            var v2 = document.getElementById("input_quadra").value;
            var v3 = document.getElementById("input_ini").value;  
            var v4 = document.getElementById("input_fim").value;  

            var dados = "param1=" + v1 +
                        "&param2=" + v2 +
                        "&param3=" + v3 +
                        "&param4=" + v4;

            UI_Aguardar();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/model/horario_verifica_avulso.php',
                async: true,
                data: dados,
                success: OnSuccess,
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

        function OnSuccess(response) {

            UI_Concluido();

            var v1 = response.retorno;

            if (v1 != "OK"){
                alert(v1)
            } else{
                document.getElementById("bt_salvar").disabled = false;
                document.getElementById("bt_verificahorario").style.display = "none";
            }           

        }

        function UI_Aguardar() {

            document.getElementById("bt_salvar").style.cursor = "progress";

        }

        function UI_Concluido() {
            document.getElementById("bt_salvar").style.cursor = "default";
        }   
            
    </script>    

</body>
</html>