$(document).ready(init);

function init(){
    $('#login').on('submit',autenticar)

}

function autenticar(e){
    var login = $("#email").val();
    var senha = $("#senha").val();
    e.preventDefault();
    $.ajax({

        url: "http://localhost:8887/usuario/autenticar",
        data:  { login: login, senha: senha },
        type: 'POST',
        success: logou,
        error: function() { console.log('Failed!'); },

    });


}

function logou(data){
    if(data.message != undefined){
        if(data.message.length > 0){
            $("#erro").fadeIn();
            $("#erro").html(data.message)
            return;
        }
    }

    localStorage.setItem('token', data.token)
    window.location = 'index.html';

}