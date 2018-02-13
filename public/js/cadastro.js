$(document).ready(init);

function init(){
    $('#cadastro').on('submit',cadastrar)
}

function cadastrar(e){
    var login = $("#email").val();
    var senha = $("#senha").val();
    var nome = $("#nome").val();
    e.preventDefault();
    $.ajax({

        url: "http://localhost:8887/usuario/salvar",
        data:  { login: login, senha: senha, nome: nome },
        type: 'POST',
        success: cadastrou,
        error: function() { console.log('Failed!'); },

    });


}

function cadastrou(data){
    if(data.message != undefined){
        if(data.message.length > 0){
            $("#erro").fadeIn();
            $("#erro").html(data.message)
            if(data.erro != undefined){
                window.location = 'login.html'
            }
            return;
        }
    }

    window.location = 'login.html';

}