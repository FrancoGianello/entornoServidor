function generarNumero(){
    document.getElementById("numero").innerHTML = Math.floor(Math.random() * 10)+1;
}
generarNumero();

let cantado = document.getElementById("numero").value;
let mio = document.getElementsByClassName("cosa").value;
function comprobar(){
    if(mio==cantado){
        // document.getElementsByClassName("cosa").style.setProperty('background-color', 'red');
        generarNumero();
    }
}