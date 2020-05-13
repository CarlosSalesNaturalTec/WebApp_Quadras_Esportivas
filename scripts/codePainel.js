function menuresponsive() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

function sair() {
    document.getElementById('DivLogOut').style.display = "block";
}

function sair_cancel() {
    document.getElementById('DivLogOut').style.display = 'none';
}

function sair_exit() {
    window.open('index.php', '_parent');
}