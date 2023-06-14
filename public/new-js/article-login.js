var loginsect = document.getElementById('login-sect');
var registersect = document.getElementById('register-sect');

function register(){
    loginsect.style.display = 'none';
    registersect.style.display = 'block';
}function signin(){
    loginsect.style.display = 'block';
    registersect.style.display = 'none';
}