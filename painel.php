<?php
    require_once('model/webservice.php');
    $ws = new WebService();
    $ws->login();
?>


<!DOCTYPE html>
<html>

<head>
<title>Arena FSA</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/w3.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/painel.css" />

    <script src="assets/js/jquery.min.js"></script>

    <style>
        body {
            background-image: url("images/fundo.jpg");
        }
    </style>

</head>

<body>

    <!-- MENU -->
    <div class="topnav" id="myTopnav">

        <a href="home.php" target="iframe" class="active"><i class="fa fa-home"></i></a>

        <div class="dropdown">
            <button class="dropbtn"><i class="fa fa-cog"></i>&nbsp;Sistema 
            <i class="fa fa-caret-down"></i>&nbsp;
            </button>
            <div class="dropdown-content">
                <a href="cad_usuarios_listagem.php" target="iframe"><i class="fa fa-key"></i>&nbsp;Usuários&nbsp;</a>
            </div>
        </div>  

        <div class="dropdown">
            <button class="dropbtn"><i class="fa fa-list"></i>&nbsp;Cadastro&nbsp;<i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="cad_quadras_listagem.php" target="iframe"><i class="fa fa-shopping-bag"></i>&nbsp;Quadras</a>
                <a href="cad_clientes_filtro.php" target="iframe"><i class="fa fa-users"></i>&nbsp;Clientes</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn"><i class="fa fa-calendar"></i>&nbsp;Locações&nbsp;<i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="cad_locacoes_listagem2.php" target="iframe"><i class="fa fa-list"></i>&nbsp;Histórico de Locações</a>
                <a href="cad_locacoes_listagem.php" target="iframe"><i class="fa fa-calendar"></i>&nbsp;Cadastro de Locações</a>            
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn"><i class="fa fa-list"></i>&nbsp;Financeiro&nbsp;<i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="cad_despesas_filtro.php" target="iframe">&nbsp;<i class="fa fa-dollar"></i>&nbsp;&nbsp;Despesas Diversas</a>
                <a href="sorry.php" target="iframe"><i class="fa fa-credit-card"></i>&nbsp;Controle de Recebimentos</a>
                <a href="caixa_filtro.php" target="iframe"><i class="fa fa-calendar"></i>&nbsp;Caixa</a>
            </div>
        </div>

        <a href="#" onclick="sair()"><i class="fa fa-sign-out"></i> Sair</a>
        <a href="javascript:void(0);" style="font-size: 15px;" class="icon" onclick="menuresponsive()">&#9776;</a>

        <a id="userName" class="w3-right w3-text-white w3-animate-left"></a>
    </div>

    <!-- page content -->
    <div>
        <iframe src="home.php" width="100%" height="580px" frameborder="0" name="iframe">Atualize seu Navegador!</iframe>
    </div>

     <!-- Modal LogOff -->
     <div id="DivLogOut" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-left" style="max-width: 400px">

            <form class="w3-container">
                <div class="w3-section w3-center">
                    <header class="w3-container w3-green w3-center">
                        <h4><strong>Atenção</strong></h4>
                    </header>
                    <br />
                    <i class="fa fa-3x fa-exclamation-triangle" aria-hidden="true"></i>
                    <br />
                    <h3><strong>Confirma Saida?</strong> </h3>
                    <br />
                    <p>
                        <button type="button" class="w3-button w3-round w3-border w3-light-green w3-hover-green" onclick="sair_cancel()">Não</button>&nbsp;&nbsp;&nbsp;
                        <button type="button" class="w3-button w3-round w3-border w3-light-green w3-hover-red" onclick="sair_exit()">Sim</button>
                    </p>
                    <br />
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="scripts/codePainel.js"></script>

    <?php
        $nomeUser = $_SESSION["SECusername"];
        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('userName').innerHTML='Usuário: ".$nomeUser."';");
        echo ("</script>");
    ?>

</body>
</html>