document.addEventListener('DOMContentLoaded', function () {

    eventListeners();

    darkMode();

    

});


function darkMode() {

    // botonesDM(); //// <<<<<< Agregado

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    //console.log(prefiereDarkMode.matches);

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function () {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    })

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    })
}
function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

}
function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');
}


/** AGREGANDO COSAS */

// Botones en otro color en el Dark Mode

// function botonesDM(){

//     console.log('Desde Botones 00');
//     const botonesAmaCambiar = document.querySelectorAll('.boton-amarillo');
//     const botonesAmaCambiarB = document.querySelectorAll('.boton-amarillo-block');
//     const botonesRojCambiarB = document.querySelectorAll('.boton-rojo-block');
//     const botonesRojCambiar = document.querySelectorAll('.boton-rojo');


//     botonesAmaCambiar.forEach(e => {
//         console.log('Desde Botones 01');
//         e.classList.toggle('boton-gris');
//         e.classList.toggle('boton-amarillo');
//     });
//     botonesAmaCambiarB.forEach(e => {
//         console.log('Desde Botones 02');
//         e.classList.toggle('boton-gris-block');
//         e.classList.toggle('boton-amarillo-block');
//     });
//     botonesRojCambiar.forEach(e => {
//         console.log('Desde Botones 01');
//         e.classList.toggle('boton-negro');
//         e.classList.toggle('boton-rojo');
//     });
//     botonesRojCambiarB.forEach(e => {
//         console.log('Desde Botones 02');
//         e.classList.toggle('boton-negro-block');
//         e.classList.toggle('boton-rojo-block');
//     });

// }