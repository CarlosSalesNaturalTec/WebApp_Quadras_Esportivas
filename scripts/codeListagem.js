function Excluir(IDExc) {
    document.getElementById('HiddenID').value = IDExc;
    document.getElementById('DivModal').style.display = "block";
}

function Excluir_cancel() {
    document.getElementById('DivModal').style.display = 'none';
}

function Excluir_Registro(paramAux) {
    
    //paramentros
    var idRegistro = document.getElementById('HiddenID').value;
    var dados = "param0=" + paramAux + "&param1=" + idRegistro;

    //UI
    $("body").css("cursor", "progress");

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'model/delete_service.php',
        async: true,
        data: dados,
        success: function(response) {
            //location.reload();
        },
        failure: function (response) {
            alert("Tente novamente");
        },
        error: function () {
            //alert("Retorno deve ser em JSON");
            $("body").css("cursor", "default");
            document.getElementById('DivModal').style.display = 'none';
            location.reload();
        }
    });

}