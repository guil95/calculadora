$(document).ready(init);

function init(){
    $('#login').on('submit',autenticar)
}

function autenticar(e){
    e.preventDefault();
    $.ajax({

        url: "http://localhost:8887/usuario/autenticar",
        data:  { login: "guilherme@a.com", senha: "gui123" },
        type: 'POST',
        success: logou,
        error: function() { alert('Failed!'); },

    });


}

function logou(data){
    localStorage.setItem('token', data.token)
    window.location = 'index.html';

}