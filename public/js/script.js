$(document).ready(init);

function init(){
    if(!localStorage.getItem('token')){
        window.location = 'login.html'
    }


    $("#calculadora").on('submit', calcular)

    $("#sair").on("click", sair)
}
function sair(){
    $.ajax({

        url: "http://localhost:8887/usuario/logout",
        type: 'POST',
        success: saiu,
        error: function() { console.log('Failed!'); },

    });
}

function saiu() {
    window.location = "login.html"
    localStorage.setItem('token','');
}
function calcular(e){
    e.preventDefault();
    var valor1 = $("#valor1").val();
    var valor2 = $("#valor2").val();
    var operacao = $("#operacoes").val();


    var data = {
        valor1: valor1,
        valor2: valor2,
        metodo: operacao,
    }
    e.preventDefault();
    $.ajax({

        url: "http://localhost:8887/calculadora",
        data:  { valor1: valor1, valor2: valor2, metodo: operacao },
        type: 'POST',
        success: calculou,
        error: function() { console.log('Failed!'); },

    });
}

function calculou(data){
    if(data.message != undefined){
        if(data.message.length > 0){
            $("#erro").fadeIn();
            $("#erro").html(data.message)
            console.log(data)
            if(data.erro != undefined){
                window.location = 'login.html'
            }
            return;
        }
    }else{
        $("#erro").fadeOut();
    }

    if(data.data != undefined){
        $("#total").html('Resultado:' + data.data)
    }


}
