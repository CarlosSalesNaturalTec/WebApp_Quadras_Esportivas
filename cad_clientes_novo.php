<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
?>

<!DOCTYPE html>
<html>

<head>

    <title>Cadastro de Novo Cliente</title>
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
        <form class="form-horizontal" action="model/cad_clientes_service.php" method="POST">
            <fieldset>
                <div class="form-group">

                     <!-- Dados Pessoais -->
                     <div class="form-group">
                        <div class="col-md-1 w3-center"><i class="fa fa-2x fa-user"></i></div>
                        <div class="col-md-8">
                            <h4>NOVO CLIENTE</h4>
                        </div>
                    </div>

                     <!-- nome --> 
                    <div class="form-group">
                        <label for="input_nome" class="col-md-1 control-label">Nome:</label>
                        <div class="col-md-8">
                            <input id="input_nome" name="input_nome" 
                                class ="form-control" type="text" maxlength="100" autocomplete="off" required />
                        </div> 
                    </div>

                    <!-- Nascimento / DOcumentos -->
                    <div class="form-group">
                        <label for="input_nascim" class="col-md-1 control-label">Nascimento:</label>
                        <div class="col-md-2">
                            <input id="input_nascim" name="input_nascim" 
                                class ="form-control" type="text" maxlength="20" />
                        </div>

                        <label for="input_cpf" class="col-md-1 control-label">CPF:</label>
                        <div class="col-md-2">
                            <input id="input_cpf" name="input_cpf" class ="form-control" 
                                type="text" maxlength="20" autocomplete="off" />
                        </div>

                        <label for="input_rg" class="col-md-1 control-label">RG:</label>
                        <div class="col-md-2">
                            <input id="input_rg" name="input_rg" class ="form-control" 
                                type="text" maxlength="20" autocomplete="off" />
                        </div>
                    </div>

                    <!-- Endereço -->
                    <div class="form-group">
                        <label for="input_end" class="col-md-1 control-label">Endereço:</label>
                        <div class="col-md-5">
                            <input id="input_end" name="input_end" class ="form-control" 
                                type="text" maxlength="100" autocomplete="off" />
                        </div>
                        <label for="input_numero" class="col-md-1 control-label">Número:</label>
                        <div class="col-md-2">
                            <input id="input_numero" name="input_numero" class ="form-control" 
                                type="text" maxlength="20" autocomplete="off" />
                        </div>                        
                    </div>

                    <div class="form-group">
                        <label for="input_bairro" class="col-md-1 control-label">Bairro:</label>
                        <div class="col-md-3">
                            <input id="input_bairro" name="input_bairro" class ="form-control" 
                                type="text" maxlength="50" autocomplete="off" />
                        </div>
                        <label for="input_cidade" class="col-md-1 control-label">Cidade:</label>
                        <div class="col-md-2">
                            <input id="input_cidade" name="input_cidade" class ="form-control" 
                                type="text" maxlength="50" autocomplete="off" />
                        </div> 
                        <label for="input_uf" class="col-md-1 control-label">UF:</label>
                        <div class="col-md-1">
                            <input id="input_uf" name="input_uf" class ="form-control" 
                                type="text" maxlength="2" autocomplete="off" />
                        </div>                        
                    </div>

                    <div class="form-group">
                        <label for="input_cep" class="col-md-1 control-label">CEP:</label>
                        <div class="col-md-3">
                            <input id="input_cep" name="input_cep" class ="form-control" 
                                type="text" maxlength="20" autocomplete="off" />
                        </div>
                        <label for="input_whats" class="col-md-1 control-label">WhatsApp:</label>
                        <div class="col-md-4">
                            <input id="input_whats" name="input_whats" class ="form-control" 
                                type="text" maxlength="12" placeholder="55 + ddd + número do telefone sem o 9" />
                        </div>
                    </div>

                    <!-- TElefones -->
                    <div class="form-group">
                        <label for="input_contatos" class="col-md-1 control-label">Outros Tel:</label>
                        <div class="col-md-4">
                            <input id="input_contatos" name="input_contatos" class ="form-control" 
                                type="text" maxlength="40" autocomplete="off" />
                        </div>
                    </div>

                    <!-- e-mail / instagram -->
                    <div class="form-group">
                        <label for="input_email" class="col-md-1 control-label">e-Mail:</label>
                        <div class="col-md-4">
                            <input id="input_email" name="input_email" class ="form-control" 
                                type="text" maxlength="100" autocomplete="off" />
                        </div>                     
                        <label for="input_instagram" class="col-md-1 control-label">Instagram:</label>
                        <div class="col-md-3">
                            <input id="input_instagram" name="input_instagram" class ="form-control" 
                                type="text" maxlength="50" autocomplete="off" />
                        </div>                     
                    </div>

                    <!-- Observações -->
                    <div class="form-group">
                        <label for="input_obs" class="col-md-1 control-label">Observações:</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="input_obs" name="input_obs" rows="3">
                            </textarea>
                        </div>
                    </div>

                    
                    <!-- Botões -->
                    <div class="form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <p>
                                <button type="button" class="w3-btn w3-round w3-border w3-light-blue w3-hover-red"
                                 onclick="window.location.href = 'cad_clientes_filtro.php';">
                                    <i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Voltar
                                </button>
    
                                <button class="w3-btn w3-round w3-border w3-light-blue w3-hover-green" type="submit">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Salvar&nbsp;&nbsp;
                                </button>                            
                            </p>
                         </div>  

                    </div>

                </div>

            </fieldset>
        </form>

    </div> 

    <script type="text/javascript">
        document.getElementById("input_nome").focus();
    </script>    

</body>
</html>