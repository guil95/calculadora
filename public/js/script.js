$(document).ready(init);

function init(){
    if(!localStorage.getItem('token')){
        window.location = 'login.html'
    }

    $("#calculadora").on('submit', calcular)

    $("#relatorio").on("submit", gerarRelatorio)

    $("#sair").on("click", sair)
}

function gerarRelatorio(e){
    e.preventDefault();
    var dataInicial = $("#dataInicial").val();
    var dataFinal = $("#dataFinal").val();
    $.ajax({
        data:  { dataInicial: dataInicial, dataFinal: dataFinal},
        url: "http://localhost:8887/relatorio",
        type: 'POST',
        success: gerou,
        error: function() { console.log('Failed!'); },

    });
}
function gerou(data){
    if(data.message != undefined){
        if(data.message.length > 0){
            console.log(data)
            $("#erroRel").fadeIn();
            $("#erroRel").html(data.message)
            return;
        }
    }else{
        $("#erroRel").fadeOut();
    }

    if(data.data != undefined){
        var html = ''
        var logs = data.data
        for(var i in logs){

            html += '<tr><td>'+logs[i].id+'</td><td>'+logs[i].nome+'</td><td>'+logs[i].operacao+'</td><td>'+logs[i].data+'</td></tr>'
        }

        $("#valores").html(html)
        $("#historico").fadeIn()
    }
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
