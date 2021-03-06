
<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
    $ws->login_nivel("1");  //liberado para Nivel 1 ou inferior
?>

<!DOCTYPE html>
<html>

<head>

    <title>Arena FSA</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/w3.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Paginação -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" />

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
        <h4><i class="fa fa-user"></i>&nbsp;&nbsp;Cadastro de Usuários</h4>
    </div>

    <div class="w3-container w3-padding-16" style="margin-left: 2%; margin-right: 2%">
        <button class="w3-btn w3-round w3-border w3-light-blue w3-hover-blue" 
        onclick="window.location.href = 'cad_usuarios_novo.php';">
            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Novo Usuário&nbsp;&nbsp;
        </button>
    </div>

    <!-- Listagem Cadastrados -->
    <div class="w3-container w3-border w3-round w3-padding-16 w3-light-gray w3-small" 
        style="margin-left: 2%; margin-right: 2%">
    
        <div class="table-responsive">
            <table id='tabela' class='table table-striped table-hover table-bordered'>
                <thead>
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Nome</th>
                        <th>Usuário</th>
                        <th>Nivel</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                        require_once('model/webservice.php');
                        $ws = new WebService();
                        $ws->usuarios_corpo();
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    

    <!-- Modal Excluir -->
    <div id="DivModal" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-left" style="max-width: 400px">

            <form class="w3-container">
                <div class="w3-section w3-center">
                    <header class="w3-container w3-green w3-center">
                        <h4><strong>Atenção</strong></h4>
                    </header>
                    <br />
                    <i class="fa fa-3x fa-exclamation-triangle" aria-hidden="true"></i>
                    <br />
                    <h3><strong>Confirma Exclusão?</strong> </h3>
                    <br />
                    <p>
                        <button type="button" class="w3-button w3-round w3-border w3-light-green w3-hover-green" 
                            onclick="Excluir_cancel()">Não</button>&nbsp;&nbsp;&nbsp;
                        <button type="button" class="w3-button w3-round w3-border w3-light-green w3-hover-red" 
                            onclick="Excluir_Registro('cad_usuarios_apagar')">Sim</button>
                    </p>
                    <br />
                </div>
            </form>
            <input type="hidden" id="HiddenID" />
        </div>
    </div>
    <!-- Modal Excluir -->

    <!-- Script Paginação  -->
    <script type="text/javascript" src="scripts/codePaginacao.js"></script>

    <!-- Scripts Diversos -->
    <script type="text/javascript" src="scripts/codeListagem.js"></script>

</body>
</html>