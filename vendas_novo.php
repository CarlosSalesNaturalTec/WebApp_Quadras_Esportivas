<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();

    $ws->limpa_itens_emAberto();
?>

<!DOCTYPE html>
<html>

<head>

    <title>Nova Venda</title>
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
        <h4><i class="fa fa-dollar"></i>&nbsp;&nbsp;Nova Venda</h4> 
    </div>
    <br>

    <div class="w3-row" style="margin-left: 2%; margin-right: 2%">

        <!-- Itens da Venda  -->
        <div class="w3-threequarter w3-container w3-border w3-round">    
            <div class="w3-container">
                <br>
                <form class="form-horizontal" action="model/vendas_service1.php" 
                    method="POST" name="myForm" onsubmit="return validateForm()">
                    <fieldset>
                        <div class="form-group">
                            
                            <!-- Produtos -->
                            <div class="form-group">                               
                                <div class="col-md-4">
                                    <select id="input_produto" name="input_produto" 
                                        class="form-control" onchange="localiza_produto()">
                                        <option value="X">Selecione um produto</option>
                                        <?php
                                            require_once('model/webservice.php');
                                            $ws = new WebService();
                                            echo( $ws->select_produtos());
                                        ?>
                                    </select>
                                </div>

                                <label for="input_preco" class="col-md-1 control-label">Preço.:</label>
                                <div class="col-md-2">
                                    <input id="input_preco" name="input_preco" class ="form-control" value="0" />    
                                </div>

                                <label for="input_quant" class="col-md-1 control-label">Quant.:</label>
                                <div class="col-md-2">
                                    <input id="input_quant" name="input_quant" value="1"
                                        class ="form-control" type="number" min="1"/>    
                                </div>

                                <div class="col-md-1">
                                    <button type="button" class="w3-btn w3-round w3-border w3-light-blue" 
                                        data-toggle="tooltip" title="Adicionar Produto" onclick="insereItem();">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button> 
                                </div>

                                <div class="col-md-1">
                                    <i id="icog" style="display: none" class="fa-2x fa fa-cog fa-spin fa-fw"></i>           
                                </div>
                            </div>

                            <!-- Listagem de Itens da Compra -->
                            <div class="form-group">
                                <div class="col-md-12 w3-border w3-round">
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
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <!-- Descontos e Total -->
                            <div class="form-group">
                                <label for="input_desc1" class="col-md-1 control-label">Desc.%</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input id="input_desc1" name="input_desc1" 
                                            class ="form-control" type="number" value="0" step="any"
                                            onfocus="document.getElementById('input_desc1').select();" />   
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="button" 
                                                onclick="calcula_desconto();"><i class="fa fa-calculator"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <label for="input_desc2" class="col-md-1 control-label">Desc.R$</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input id="input_desc2" name="input_desc2" 
                                            class ="form-control" type="number" value="0" step="any"
                                            onfocus="document.getElementById('input_desc2').select();" />   
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="button" 
                                                onclick="calcula_desconto();"><i class="fa fa-calculator"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <label for="input_total" class="col-md-1 control-label">Total</label>
                                <div class="col-md-2">
                                    <input id="input_total" name="input_total" 
                                    onfocus="document.getElementById('input_desc1').focus();"
                                    class ="form-control" type="number" value="0" step="any"/>    
                                </div>
                            </div>

                            <!-- Cliente -->
                            <div class="form-group">
                                <label for="input_matricula" class="col-md-1 control-label">Matrícula:</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input id="input_matricula" name="input_matricula" 
                                            class ="form-control" type="number" value="0" 
                                            onfocus="document.getElementById('input_matricula').select();" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="button" 
                                                onclick="localiza_cliente();"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                   
                                <label for="input_cliente" class="col-md-1 control-label">Cliente:</label>
                                <div class="col-md-6">
                                    <input id="input_cliente" name="input_cliente" 
                                    class ="form-control" type="text" value = "Venda Avulsa" disabled/>    
                                </div>
                                <div class="col-md-1">
                                    <i id="icog2" style="display: none" class="fa-2x fa fa-cog fa-spin fa-fw"></i>           
                                </div>
                            </div>

                            <!-- Formas de Pagamento -->
                            <div class="col-md-12 w3-border w3-round">
                                <br>
                                <p><strong>FORMA DE PAGAMENTO</strong></p>
                                <!-- Dinheiro -->
                                <div class="form-group">
                                    <label for="input_dinheiro" class="col-md-1 control-label">Dinheiro: </label>
                                    <div class="col-md-3">
                                        <input id="input_dinheiro" name="input_dinheiro" 
                                        onfocus="document.getElementById('input_dinheiro').select();"
                                        class ="form-control" type="number" value="0" step="any"/>    
                                    </div>
                                </div>
                                <!-- Débito -->
                                <div class="form-group">                                
                                    <label for="input_debito" class="col-md-1 control-label">Débito: </label>
                                    <div class="col-md-3">
                                        <input id="input_debito" name="input_debito" 
                                        onfocus="document.getElementById('input_debito').select();"
                                        class ="form-control" type="number" value="0" step="any"/>    
                                    </div>
                                    <label for="input_debito_bandeira" class="col-md-1 control-label">Bandeira: </label>
                                    <div class="col-md-3">
                                        <input id="input_debito_bandeira" name="input_debito_bandeira" 
                                        onfocus="document.getElementById('input_debito_bandeira').select();"
                                        class ="form-control" type="text" maxlength="30"/>    
                                    </div>  
                                </div>
                                <!-- Crédito -->
                                <div class="form-group">
                                    <label for="input_credito" class="col-md-1 control-label">Crédito: </label>
                                    <div class="col-md-3">
                                        <input id="input_credito" name="input_credito" 
                                        onfocus="document.getElementById('input_credito').select();"
                                        class ="form-control" type="number" value="0" step="any"/>    
                                    </div>
                                    <label for="input_credito_bandeira" class="col-md-1 control-label">Bandeira: </label>
                                    <div class="col-md-3">
                                        <input id="input_credito_bandeira" name="input_credito_bandeira" 
                                        onfocus="document.getElementById('input_credito_bandeira').select();"
                                        class ="form-control" type="text" maxlength="30"/>    
                                    </div>
                                    <!--<label for="input_credito_parcelas" class="col-md-1 control-label">Parcelas: </label>-->
                                    <div class="col-md-3">
                                        <input id="input_credito_parcelas" name="input_credito_parcelas" 
                                        onfocus="document.getElementById('input_credito_parcelas').select();"
                                        class ="form-control" type="hidden" value="1" min="1" />    
                                    </div>  
                                </div>
                                <!-- Depósito Bancário -->
                                <div class="form-group">
                                    <label for="input_deposito" class="col-md-1 control-label">Depósito: </label>
                                    <div class="col-md-3">
                                        <input id="input_deposito" name="input_deposito" 
                                        onfocus="document.getElementById('input_deposito').select();"
                                        class ="form-control" type="number" value="0" step="any"/>    
                                    </div>  
                                </div>
                                <!-- Carnê -->
                                <div class="form-group">
                                    <label for="input_carne" class="col-md-1 control-label">Carnê: </label>
                                    <div class="col-md-3">
                                        <input id="input_carne" name="input_carne" 
                                        onfocus="document.getElementById('input_carne').select();"
                                        onblur="parcelamento_carne();"
                                        class ="form-control" type="number" value="0" step="any"/>    
                                    </div>

                                    <label for="input_carne_parcelas" class="col-md-1 control-label">Parcelas: </label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input id="input_carne_parcelas" name="input_carne_parcelas" 
                                                onfocus="document.getElementById('input_carne_parcelas').select();"
                                                onblur="parcelamento_carne();"
                                                class ="form-control" type="number" value="1" min="1"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="button" 
                                                    onclick="parcelamento_carne();"><i class="fa fa-calculator"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="input_carne_parcelas_valor" class="col-md-1 control-label">Valor: </label>
                                    <div class="col-md-3">
                                        <input id="input_carne_parcelas_valor" name="input_carne_parcelas_valor" 
                                        onfocus="document.getElementById('input_carne_parcelas_valor').select();"
                                        class ="form-control" type="number" value="0" step="any"/>    
                                    </div>  
                                </div>

                            </div>
                            
                            <!-- Concluir / Cancelar-->
                            <div class="col-md-12 w3-border w3-round">
                                <br>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <button class="w3-btn w3-block w3-round w3-border w3-red" 
                                            type="button" id="btcancelar" onclick="cancelar();">
                                            <i class="fa fa-ban" aria-hidden="true"></i>&nbsp;Cancelar
                                        </button> 
                                    </div> 
                                    <div class="col-md-1"></div>
                                    <div class="col-md-7">
                                        <button class="w3-btn w3-block w3-round w3-border w3-green" 
                                            type="submit" id="btsalvar">
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Concluir
                                        </button> 
                                    </div>  
                                </div>
                            </div>

                        </div>

                        <input id="input_total_2" name="input_total_2" 
                            class ="form-control" type="hidden" value="0" /> 
                        <input id="input_total_3" name="input_total_3" 
                            class ="form-control" type="hidden" value="0" /> 

                    </fieldset>
                </form>

            </div> 
        </div>

        <!-- Imagens   -->
        <div class="w3-quarter w3-container">
            <br>
            <div id="results" class="col-md-12 w3-padding-16"></div>

            <br>
            <div id="resultsCli" class="col-md-12 w3-padding-16"></div>
        </div>

    </div>

    <!-- Scripts Diversos -->
    <script type="text/javascript">

        document.getElementById("input_produto").focus();

        function localiza_cliente() {

            var v1 = document.getElementById("input_matricula").value;
            if (v1 == "0"){
                document.getElementById("input_cliente").value = "Venda Avulsa";
                return;
            }

            document.getElementById("icog2").style.display = "block";

            var dados = "param0=matricula" +
                        "&param1=" + v1;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/model/vendas_service.php',
                async: true,
                data: dados,
                success: OnSuccess,
                failure: function (response) {
                    document.getElementById("icog2").style.display = "none";
                    alert("Tente novamente");
                },
                error: function () {
                    document.getElementById("icog2").style.display = "none";
                    alert("Não foi possível localizar Cliente");
                }
            });

        }

        function OnSuccess(response) {

            var v1 = response.retorno;
            var v2 = response.retorno2;

            document.getElementById("icog2").style.display = "none";

            switch (v1) {
                case "X":
                    document.getElementById("input_cliente").value = "MATRÍCULA NÃO LOCALIZADA";
                    document.getElementById("input_matricula").value = "0";
                    alert("Matrícula Não Localizada");
                    break;

                default:
                    document.getElementById("input_cliente").value = v1;
                    document.getElementById('resultsCli').innerHTML = v2;
                    break;
            }

        }

        function localiza_produto() {

            var v1 = document.getElementById("input_produto").value;
            if (v1 == "X"){
                document.getElementById("input_preco").value = "0";
                return;
            }

            var dados = "param0=produto" +
                        "&param1=" + v1;
            document.getElementById("icog").style.display = "block";

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/model/vendas_service.php',
                async: true,
                data: dados,
                success: OnSuccess_Produto,
                failure: function (response) {
                    document.getElementById("icog").style.display = "none";
                    alert("Tente novamente");
                },
                error: function () {
                    document.getElementById("icog").style.display = "none";
                    alert("Não foi possível localizar Produto");
                }
            });

        }

        function OnSuccess_Produto(response) {

            var v1 = response.retorno;
            var v2 = response.retorno2;
            
            document.getElementById("input_preco").value = v1;
            
            var v_path = "<img src=\"" + v2 + "\">";
            document.getElementById('results').innerHTML = v_path;

            document.getElementById("icog").style.display = "none";
            document.getElementById("input_quant").select();

        }

        function insereItem() {

            //validações
            var v1 = document.getElementById("input_produto").value;    //ID do produto
            if (v1 == "X"){ return; }
            var v2 = document.getElementById("input_quant").value;      //quant
            if (v2 == ""){ return; }
            if (v2 <= 0 ){ return; }
            var v3 = document.getElementById("input_preco").value;      //valor unitário
            if (v3 == ""){ return; }
            if (v3 <= 0 ){ return; }
            var v4 = v2*v3;                                             //total do item

            document.getElementById("icog").style.display = "block";

            var dados = "param0=inserir" +
                        "&param1=" + v1 +
                        "&param2=" + v2 +
                        "&param3=" + v3 +
                        "&param4=" + v4;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/model/vendas_service.php',
                async: true,
                data: dados,
                success: OnSuccess_Insert,
                failure: function (response) {
                    document.getElementById("icog").style.display = "none";
                    alert("Tente novamente");
                },
                error: function () {
                    document.getElementById("icog").style.display = "none";
                    alert("Não foi possível inserir item");
                }
            });

        }

        function OnSuccess_Insert(response) {

            var v1 = response.retorno;
            if (v1 == false) { return; }

            // Insere Linha
            var e = document.getElementById("input_produto");
            var col1 = e.options[e.selectedIndex].text;

            var col2 = document.getElementById("input_quant").value;
            var col3 = document.getElementById("input_preco").value;
            var col4 = col2 * col3;     // Total

            var totalAtual = parseFloat(document.getElementById("input_total_2").value);
            totalAtual += col4;

            var desc1 = 0; 
            var desc2 = 0;
            if( parseFloat(document.getElementById("input_desc1").value ) > 0 ){
                desc1 = totalAtual * (parseFloat(document.getElementById("input_desc1").value) / 100);
            } else {
                desc1 = 0;
            }

            if( parseFloat(document.getElementById("input_desc2").value ) > 0 ){
                desc2 = document.getElementById("input_desc2").value;
            } else {
                desc2 = 0;
            }

            var totalcomDesconto = totalAtual - desc1 - desc2;
            
            var table = document.getElementById("tabela");

            var row = table.insertRow(1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);

            cell1.innerHTML = col1;
            cell2.innerHTML = col2;
            cell3.innerHTML = col3;
            cell4.innerHTML = col4;

            document.getElementById("input_preco").value="0";
            document.getElementById("input_quant").value="1";
            document.getElementById("input_produto").value="X";
            document.getElementById("input_produto").focus();

            document.getElementById("input_total_2").value = totalAtual;
            document.getElementById("input_total_3").value = desc1 + desc2;
            document.getElementById("input_total").value = totalcomDesconto.toFixed(2);
            //document.getElementById("input_parcela_valor").value = totalcomDesconto.toFixed(2);;

            document.getElementById("icog").style.display = "none";

        }

        function validateForm() { 

            //verifica Total=0
            var x = document.forms["myForm"]["input_total"].value;
            if (x == "0") {
                alert("Valor não pode ser igual a Zero");
                return false;
            }

            //verifica total geral - pagamento fracionado
            var x1 = document.getElementById("input_dinheiro").value;
            var x2 = document.getElementById("input_debito").value;
            var x3 = document.getElementById("input_credito").value;
            var x4 = document.getElementById("input_deposito").value;
            var x5 = document.getElementById("input_carne").value;
            var xtotal = parseFloat(x1) + parseFloat(x2) + parseFloat(x3) + parseFloat(x4) + parseFloat(x5);
            if (xtotal != x) {
                alert("A soma dos pagamentos é diferente do Valor Total da Venda!");
                return false;
            }

            //Validações Venda em Cartão de Débito
            var e = document.getElementById("input_debito").value;
            if (e > 0) {
                //verifica bandeira
                var e = document.getElementById("input_debito_bandeira").value;
                if (e == "") {
                    document.getElementById("input_debito_bandeira").select();
                    alert("Informe Bandeira do Cartão de Débito!");
                    return false;
                }
            }

            //Validações Venda em Cartão de Crédito
            var e = document.getElementById("input_credito").value;
            if (e > 0) {
                //verifica bandeira
                var e = document.getElementById("input_credito_bandeira").value;
                if (e == "") {
                    document.getElementById("input_credito_bandeira").select();
                    alert("Informe Bandeira do Cartão de Crédito!");
                    return false;
                }
                //verifica numero de parcelas
                var e = document.getElementById("input_credito_parcelas").value;
                if (e <= 0 || e > 12) {
                    document.getElementById("input_credito_parcelas").select();
                    alert("Número de parcelas inválido!");
                    return false;
                }
            }

            //Validações Venda em Carnê
            var e = document.getElementById("input_carne").value;
            if (e > 0) {
                //verifica se informou matrícula do cliente
                var e = document.getElementById("input_matricula").value;
                if (e == "0") {
                    document.getElementById("input_matricula").select();
                    alert("Para venda em carnê necessário informar Cliente!");
                    return false;
                }
                //verifica numero de parcelas
                var e = document.getElementById("input_carne_parcelas").value;
                if (e <= 0 || e > 12) {
                    document.getElementById("input_carne_parcelas").select();
                    alert("Número de parcelas inválido!");
                    return false;
                }
            }

        }

        function parcelamento_carne() {

            var v1 = document.getElementById("input_carne").value;
            var v2 = document.getElementById("input_carne_parcelas").value;
            if(v2 <=0){ return;}

            var v3 = parseFloat(v1) / parseFloat(v2);
            var v4 = parseFloat(v3).toFixed(2)
            document.getElementById("input_carne_parcelas_valor").value = v4;

        }

        function calcula_desconto(){

            var totalAtual = parseFloat(document.getElementById("input_total_2").value);
            var totalcomDesconto = 0;

            var desc1 = 0;
            var desc2 = 0;

            if( parseFloat(document.getElementById("input_desc1").value ) > 0 ){
                desc1 = totalAtual * (parseFloat(document.getElementById("input_desc1").value) / 100);
            } else {
                desc1 = 0;
            }

            if( parseFloat(document.getElementById("input_desc2").value ) > 0 ){
                desc2 = document.getElementById("input_desc2").value;
            } else {
                desc2 = 0;
            }
            
            totalcomDesconto = totalAtual - desc1 - desc2;
            document.getElementById("input_total").value = totalcomDesconto.toFixed(2);
            document.getElementById("input_total_3").value = desc1 + desc2;
            //document.getElementById("input_parcela_valor").value = totalcomDesconto.toFixed(2);;

        }

        function cancelar() {

            document.getElementById("icog").style.display = "block";

            var dados = "param0=cancelar" +
                        "&param1=X" +
                        "&param2=X" +
                        "&param3=X" +
                        "&param4=X" ;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/model/vendas_service.php',
                async: true,
                data: dados,
                success: OnSuccess_cancelar,
                failure: function (response) {
                    document.getElementById("icog").style.display = "none";
                    alert("Tente novamente");
                },
                error: function () {
                    document.getElementById("icog").style.display = "none";
                    alert("Não foi possível cancelar");
                }
            });

        }

        function OnSuccess_cancelar(response) {

            window.location.href = "vendas_listagem.php?param=01";

        }

    
    </script>

</body>
</html>