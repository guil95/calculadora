$(document).ready(init);

function init(){
    if(!localStorage.getItem('token')){
        window.location = 'login.html';
    }
}