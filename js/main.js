// Obtener la hora con JavaScript
let fecha = new Date();
let hora = fecha.getHours();

if(hora >= 1){
    saludo = 'Vete a dormir';
}

if(hora >= 8){
    var saludo = 'Buenos dias';
}

if(hora >= 12){
    saludo = 'Buenas tardes';
}

if(hora >= 19){
    saludo = 'Buenas noches';
}

console.log(hora);