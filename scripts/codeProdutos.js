document.getElementById("input_nome").focus();

function exibe_foto(){
    var url_Foto = document.getElementById('input_URL').value;
    document.getElementById('results').innerHTML = '<img src=\"' + url_Foto + '\"/>';
}

function VerificaNome() {

    var v1 = document.getElementById("input_nome").value;
    
    var dados = "param0=" + v1;

    UI_Aguardar();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/model/cad_produtos_service2.php',
        async: true,
        data: dados,
        success: OnSuccess,
        failure: function (response) {
            alert("Tente novamente");
        },
        error: function () {
            alert("Retorno deve ser em JSON");
        }
    });

}

function OnSuccess(response) {

    UI_Concluido();

    var v1 = response.retorno;

    switch (v1) {
        case "0":
            break;
        default:
            var mensagem = "Ja existe produto cadastrado com este Nome."
            alert(mensagem)
            break;
    }

}

function UI_Aguardar() {
    $("body").css("cursor", "progress");
}

function UI_Concluido() {
    $("body").css("cursor", "default");
}

function VerificaCodigo() {

    var v1 = document.getElementById("input_codigo").value;
    
    var dados = "param0=" + v1;

    UI_Aguardar();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/model/cad_produtos_service3.php',
        async: true,
        data: dados,
        success: OnSuccessCOD,
        failure: function (response) {
            alert("Tente novamente");
        },
        error: function () {
            alert("Retorno deve ser em JSON");
        }
    });

}

function OnSuccessCOD(response) {

    UI_Concluido();

    var v1 = response.retorno;

    switch (v1) {
        case "0":
            document.getElementById("btsalvar").disabled = false;
            break;
        default:
            document.getElementById("btsalvar").disabled = true;
            var mensagem = "Ja existe produto cadastrado com este CÓDIGO."
            alert(mensagem)
            break;
    }

}