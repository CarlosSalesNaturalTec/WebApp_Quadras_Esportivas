<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
    $ws->login_nivel("1");  //liberado para Nivel 1 ou inferior
?>

<!DOCTYPE html>
<html>

<head>

    <title>Ficha de Usuário</title>
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
        <h4><i class="fa fa-user"></i>&nbsp;&nbsp;Ficha de Usuário</h4>
    </div>
    <br>

    <!-- Cadastro  -->
    <div class="w3-container w3-border w3-round" style="margin-left: 2%; margin-right: 2%">
        <br>
        <form class="form-horizontal" action="model/cad_usuarios_service1.php" method="POST">
            <fieldset>
                <div class="form-group">

                    <div class="form-group">
                        <label for="input_nome" class="col-md-1 control-label">Nome:</label>
                        <div class="col-md-4">
                            <input id="input_nome" name="input_nome" 
                                class ="form-control" type="text" maxlength="100" required/>
                        </div> 
                        <label for="input_user" class="col-md-1 control-label">Usuário:</label>
                        <div class="col-md-4">
                            <input id="input_user" name="input_user" 
                                class ="form-control" type="text" maxlength="100" required/>
                        </div> 
                    </div>  

                    <div class="form-group">
                        <label for="select_nivel" class="col-md-1 control-label">Nivel:</label>
                        <div class="col-md-4">
                            <select id="select_nivel" name="select_nivel" class ="form-control">
                                <option value="1">Administrador</option>
                                <option value="2">Operacional</option>
                            </select>
                        </div> 
                        <label for="input_pwd" class="col-md-1 control-label">Senha:</label>
                        <div class="col-md-4">
                            <input id="input_pwd" name="input_pwd" 
                                class ="form-control" type="password" required/>
                        </div> 
                    </div>  

                    <div class="form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <p>
                                <button type="button" class="w3-btn w3-round w3-border w3-light-blue w3-hover-red"
                                 onclick="window.location.href = 'cad_usuarios_listagem.php';">
                                    <i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Voltar
                                </button>
    
                                <button class="w3-btn w3-round w3-border w3-light-blue w3-hover-green" type="submit">
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
        $ws->cad_usuarios_ficha($id_aux);
    ?>      

</body>
</html>