document.getElementById("inputUserOper").focus();

function TentarLoginOper() {

    var v1 = document.getElementById("inputUserOper").value;
    var v2 = document.getElementById("inputPwdOper").value;   

    var dados = "param0=" + v1 +
                "&param1=" + v2;

    UI_Aguardar();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/model/login.php',
        async: true,
        data: dados,
        success: OnSuccess,
        failure: function (response) {
            alert("Falha. Tente novamente");
        },
        error: function () {
            alert("Erro ao conectar com banco de dados");
        }
    });

}

function OnSuccess(response) {

    UI_Concluido();

    var v1 = response.retorno;

    switch (v1) {
        case "0":
            document.getElementById('lblMsgRetorno').innerText = "Usuário Não Cadastrado.";
            break;
        case "2":
            document.getElementById('lblMsgRetorno').innerText = "Senha Incorreta!";
            break;
        default:
            window.location.href = v1;
            break;
    }

}

function UI_Aguardar() {

    document.getElementById("btLoginOper").style.cursor = "progress";

    var i, x;

    document.getElementById('lblMsgRetorno').innerText = "";

    x = document.getElementsByClassName("btcontroles");
    for (i = 0; i < x.length; i++) {
        x[i].disabled = true;
    }

    x = document.getElementsByClassName("aguarde");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "block";
    }
}

function UI_Concluido() {
    var i, x;

    x = document.getElementsByClassName("btcontroles");
    for (i = 0; i < x.length; i++) {
        x[i].disabled = false;
    }

    x = document.getElementsByClassName("aguarde");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
}

