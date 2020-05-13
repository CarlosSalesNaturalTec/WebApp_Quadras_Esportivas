<?php
    session_start();
    unset($_SESSION["SECusername"]);
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <title>Arena FSA</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->

    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

</head>

<body class="landing">
    <div id="page-wrapper">

        <!-- Menu -->
        <header id="header">
            <h1 id="logo"><a href="index.php">Arena FSA</a></h1>
            <nav id="nav">
            </nav>
        </header>

        <!-- Corpo -->
        <section id="banner">
            <div class="content">
                <header>
                    <h2><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Login</h2>
                    <p>
                        <input id="inputUserOper" placeholder="Usuário" class="w3-input w3-border w3-round" type="text" />
                    </p>
                    <p>
                        <input id="inputPwdOper" placeholder="Senha" class="w3-input w3-border w3-round" type="password" />
                    </p>
                    <p>
                        <a href="#" id="btLoginOper" class="btcontroles button special small" onclick="TentarLoginOper()">&nbsp;&nbsp;&nbsp;Entrar&nbsp;&nbsp;&nbsp;</a>
                    </p>
                    <i style="display: none" class="aguarde fa-2x fa fa-cog fa-spin fa-fw"></i>
                    <span id="lblMsgRetorno"></span>
                </header>
            </div>
        </section>

    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="assets/js/main.js"></script>

    <!-- Script Auxiliar -->
    <script type="text/javascript" src="scripts/codeLogin.js"></script>

</body>

</html>
