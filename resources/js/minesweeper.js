//el código original es de la página https://www.adictosaltrabajo.com/2020/06/03/programar-un-buscaminas-en-javascript-con-tu-hijo/ 
const buscaminas = {
    numMinasTotales: 12,
    numMinasEncontradas: 0,
    numFilas: 15,
    numColumnas: 15,
    aCampoMinas: [],
};

function pintarTablero() {
    //seleccionamos el objeto tablero
    let tablero = document.querySelector("#tablero");

    //actualizamos las variables CSS con las variables JavaScript
    document
        .querySelector("html")
        .style.setProperty("--num-filas", buscaminas.numFilas);
    document
        .querySelector("html")
        .style.setProperty("--num-columnas", buscaminas.numColumnas);

    //borramos el tablero actual
    while (tablero.firstChild) {
        tablero.firstChild.removeEventListener("contextmenu", marcar);
        tablero.firstChild.removeEventListener("click", destapar);
        tablero.firstChild.removeEventListener("touchstart", destapar);
        tablero.firstChild.removeEventListener("touchend", marcar);
        tablero.removeChild(tablero.firstChild);
    }
    //los eventos touch son creados por mí para poder jugar desde el móvil 

    //creamos las casillas que necesitemos
    for (let f = 0; f < buscaminas.numFilas; f++) {
        for (let c = 0; c < buscaminas.numColumnas; c++) {
            let newDiv = document.createElement("div");
            newDiv.setAttribute("id", "f" + f + "_c" + c);
            newDiv.dataset.fila = f;
            newDiv.dataset.columna = c;
            newDiv.addEventListener("contextmenu", marcar); //evento con el botón derecho del raton
            newDiv.addEventListener("click", destapar); //evento con el botón izquierdo del raton
            newDiv.addEventListener("touchstart", destapar); //evento movil
            newDiv.addEventListener("touchend", marcar); //evento movil
            tablero.appendChild(newDiv);
        }
    }
}

function generarCampoMinasVacio() {
    //generamos el campo de minas
    buscaminas.aCampoMinas = new Array(buscaminas.numFilas);
    for (let fila = 0; fila < buscaminas.numFilas; fila++) {
        buscaminas.aCampoMinas[fila] = new Array(buscaminas.numColumnas);
    }
}

function esparcirMinas() {
    //repartimos de forma aleatoria las minas
    let numMinasEsparcidas = 0;

    while (numMinasEsparcidas < buscaminas.numMinasTotales) {
        //numero aleatorio en el intervalo [0,numFilas-1]
        let fila = Math.floor(Math.random() * buscaminas.numFilas);

        //numero aleatorio en el intervalo [0,numColumnas-1]
        let columna = Math.floor(Math.random() * buscaminas.numColumnas);

        //si no hay bomba en esa posicion
        if (buscaminas.aCampoMinas[fila][columna] != "B") {
            //la ponemos
            buscaminas.aCampoMinas[fila][columna] = "B";

            //y sumamos 1 a las bombas esparcidas
            numMinasEsparcidas++;
        }
    }
}

function contarMinasAlrededorCasilla(fila, columna) {
    let numeroMinasAlrededor = 0;

    //de la fila anterior a la posterior
    for (let zFila = fila - 1; zFila <= fila + 1; zFila++) {
        //de la columna anterior a la posterior
        for (let zColumna = columna - 1; zColumna <= columna + 1; zColumna++) {
            //si la casilla cae dentro del tablero
            if (
                zFila > -1 &&
                zFila < buscaminas.numFilas &&
                zColumna > -1 &&
                zColumna < buscaminas.numColumnas
            ) {
                //miramos si en esa posición hay bomba
                if (buscaminas.aCampoMinas[zFila][zColumna] == "B") {
                    //y sumamos 1 al numero de minas que hay alrededor de esa casilla
                    numeroMinasAlrededor++;
                }
            }
        }
    }

    //y guardamos cuantas minas hay en esa posicion
    buscaminas.aCampoMinas[fila][columna] = numeroMinasAlrededor;
}

function contarMinas() {
    //contamos cuantas minas hay alrededor de cada casilla
    for (let fila = 0; fila < buscaminas.numFilas; fila++) {
        for (let columna = 0; columna < buscaminas.numColumnas; columna++) {
            //solo contamos si es distinto de bomba
            if (buscaminas.aCampoMinas[fila][columna] != "B") {
                contarMinasAlrededorCasilla(fila, columna);
            }
        }
    }
}

function marcar(miEvento) {
    if (miEvento.type === "contextmenu" || miEvento.type === "touchstart") {
        

        //obtenemos el elemento que ha disparado el evento
        let casilla = miEvento.currentTarget;

        //detenemos el burbujeo del evento y su accion por defecto
        miEvento.stopPropagation();
        miEvento.preventDefault();

        //obtenemos la fila de las propiedades dataset.
        //como es un string hay que convertirlo a numero
        let fila = parseInt(casilla.dataset.fila, 10);
        let columna = parseInt(casilla.dataset.columna, 10);

        if (
            fila >= 0 &&
            columna >= 0 &&
            fila < buscaminas.numFilas &&
            columna < buscaminas.numColumnas
        ) {
            //si esta marcada como "bandera"
            if (casilla.classList.contains("icon-bandera")) {
                //la quitamos
                casilla.classList.remove("icon-bandera");
                //y la marcamos como duda
                casilla.classList.add("icon-duda");
                //y al numero de minas encontradas le restamos 1
                buscaminas.numMinasEncontradas--;
            } else if (casilla.classList.contains("icon-duda")) {
                //si estaba marcada como duda lo quitamos
                casilla.classList.remove("icon-duda");
            } else if (casilla.classList.length == 0) {
                //si no está marcada la marcamos como "bandera"
                casilla.classList.add("icon-bandera");
                //y sumamos 1 al numero de minas encontradas
                buscaminas.numMinasEncontradas++;
                //si es igual al numero de minas totales resolvemos el tablero para ver si esta bien
                if (
                    buscaminas.numMinasEncontradas == buscaminas.numMinasTotales
                ) {
                    resolverTablero(true);
                }
            }

            actualizarNumMinasRestantes();
        }
    }
}
//también he añadido un temporizador para poder tener una cuenta del tiempo que cuesta resolverlo
var temporizador = true;
function destapar(miEvento) {
    if (temporizador) {
        empezar();
        temporizador = false;
    }
    if (miEvento.type === "click") {
        let casilla = miEvento.currentTarget;
        let fila = parseInt(casilla.dataset.fila, 10);
        let columna = parseInt(casilla.dataset.columna, 10);

        destaparCasilla(fila, columna);
    }
}

function destaparCasilla(fila, columna) {
    //si la casilla esta dentro del tablero
    if (
        fila > -1 &&
        fila < buscaminas.numFilas &&
        columna > -1 &&
        columna < buscaminas.numColumnas
    ) {


        //obtenermos la casilla con la fila y columna
        let casilla = document.querySelector("#f" + fila + "_c" + columna);

        //si la casilla no esta destapada
        if (!casilla.classList.contains("destapado")) {
            //si no esta marcada como "bandera"
            if (!casilla.classList.contains("icon-bandera")) {
                //la destapamos
                casilla.classList.add("destapado");

                //ponemos en la casilla el número de minas que tiene alrededor
                casilla.innerHTML = buscaminas.aCampoMinas[fila][columna];

                //ponemos el estilo del numero de minas que tiene alrededor (cada uno es de un color)
                casilla.classList.add(
                    "c" + buscaminas.aCampoMinas[fila][columna]
                );

                //si no es bomba
                if (buscaminas.aCampoMinas[fila][columna] !== "B") {
                    // y tiene 0 minas alrededor, destapamos las casillas contiguas
                    if (buscaminas.aCampoMinas[fila][columna] == 0) {
                        destaparCasilla(fila - 1, columna - 1);
                        destaparCasilla(fila - 1, columna);
                        destaparCasilla(fila - 1, columna + 1);
                        destaparCasilla(fila, columna - 1);
                        destaparCasilla(fila, columna + 1);
                        destaparCasilla(fila + 1, columna - 1);
                        destaparCasilla(fila + 1, columna);
                        destaparCasilla(fila + 1, columna + 1);

                        //y borramos el 0 poniendo la cadena vacía
                        casilla.innerHTML = "";
                    }
                } else if (buscaminas.aCampoMinas[fila][columna] == "B") {
                    // si por el contrario hay bomba quitamos la B
                    casilla.innerHTML = "";
                    //añadimos el estilo de que hay bomba
                    casilla.classList.add("icon-bomba");

                    // y que se nos ha olvidado marcarla
                    casilla.classList.add("sinmarcar");

                    // y resolvemos el tablero indicando (false), que hemos cometido un fallo
                    resolverTablero(false);
                    alert("BOOM!! HAS ENCONTRADO UNA BOMBA");
                    parar();
                    setTimeout(function () {
                        inicio();
                        reiniciar();
                        empezar();
                        buscaminas.numMinasTotales = 12;
                        buscaminas.numMinasEncontradas = 0;
                        document.querySelector("#numMinasRestantes").innerHTML =
                            buscaminas.numMinasTotales;
                    }, 1000);
                }
            }
        }
    }
}

function resolverTablero(isOK) {
    let aCasillas = tablero.children;
    for (let i = 0; i < aCasillas.length; i++) {
        //quitamos los listeners de los eventos a las casillas
        aCasillas[i].removeEventListener("click", destapar);
        aCasillas[i].removeEventListener("contextmenu", marcar);

        let fila = parseInt(aCasillas[i].dataset.fila, 10);
        let columna = parseInt(aCasillas[i].dataset.columna, 10);

        if (aCasillas[i].classList.contains("icon-bandera")) {
            if (buscaminas.aCampoMinas[fila][columna] == "B") {
                //bandera correcta
                aCasillas[i].classList.add("destapado");
                aCasillas[i].classList.remove("icon-bandera");
                aCasillas[i].classList.add("icon-bomba");
            } else {
                //bandera erronea
                aCasillas[i].classList.add("destapado");
                aCasillas[i].classList.add("banderaErronea");
                isOK = false;
            }
        } else if (!aCasillas[i].classList.contains("destapado")) {
            if (buscaminas.aCampoMinas[fila][columna] == "B") {
                //destapamos el resto de las bombas
                aCasillas[i].classList.add("destapado");
                aCasillas[i].classList.add("icon-bomba");
            }
        }
    }

    if (isOK) {
        alert("¡¡¡Enhorabuena!!!");
        pausa();
    }
}

function actualizarNumMinasRestantes() {
    document.querySelector("#numMinasRestantes").innerHTML =
        buscaminas.numMinasTotales - buscaminas.numMinasEncontradas;
}

function inicio() {
    buscaminas.numFilas = 10;
    buscaminas.numColumnas = 10;
    buscaminas.numMinasTotales = 12;
    pintarTablero();
    generarCampoMinasVacio();
    esparcirMinas();
    contarMinas();
    actualizarNumMinasRestantes();
}

window.onload = function () {
    inicio();
    visor = document.getElementById("reloj"); //localizar pantalla del reloj
    //asociar eventos a botones: al pulsar el botón se activa su función.
    //document.cron.boton1.onclick = activo;
    //document.cron.boton2.onclick = pausa;
    //document.cron.boton1.disabled = false;
    //document.cron.boton2.disabled = true;
    //variables de inicio:
    var marcha = 0; //control del temporizador
    var cro = 0; //estado inicial del cronómetro.
};
function hola() {
    inicio();
    visor = document.getElementById("reloj");
    var marcha = 0;
    var cro = 0;
}
//botón Empezar / Reiniciar
function activo() {
    if (document.cron.boton1.value == "Empezar") {
        //botón en "Empezar"
        empezar(); //ir  la función empezar
    } else {
        //Botón en "Reiniciar"
        pausa(); //ir a la función reiniciar
    }
}
//botón pausa / continuar
function pausa() {
    /*if (marcha == 0) { //con el boton en "continuar"
        continuar() //ir a la función continuar
    }*/
    //con el botón en "parar"
    parar(); //ir a la funcion parar
    //document.cron.boton1.value = "Empezar";
    var scoreBonito = mn + " mn " + sg + " sg " + cs + " cs ";
    //var score = (mn + ':' + sg + ':' + cs);
    var mins = mn;
    var sgs = sg;
    var cnts = cs;
    var tiempo = new Date();
    var mensaje = confirm(
        `Tu puntuación ha sido de: ${scoreBonito}, deseas guardarlo?`
    );
    if (mensaje) {
        guardarScore(mins, sgs, cnts);
        setTimeout(function () {
            inicio();
            reiniciar();
            empezar();
            buscaminas.numMinasTotales = 12;
            buscaminas.numMinasEncontradas = 0;
            document.querySelector("#numMinasRestantes").innerHTML =
                buscaminas.numMinasTotales;
        }, 1000);
    }
    if (!mensaje) {
        setTimeout(function () {
            inicio();
            reiniciar();
            empezar();
            buscaminas.numMinasTotales = 12;
            buscaminas.numMinasEncontradas = 0;
            document.querySelector("#numMinasRestantes").innerHTML =
                buscaminas.numMinasTotales;
        }, 1000);
    }
}
//Botón 1: Estado empezar: Poner en marcha el crono
function empezar() {
    emp = new Date(); //fecha inicial (en el momento de pulsar)
    elcrono = setInterval(tiempo, 10); //función del temporizador.
    marcha = 1; //indicamos que se ha puesto en marcha.
    //document.cron.boton1.value = "Parar"; //Cambiar estado del botón
    //document.cron.boton2.disabled = false; //activar botón de pausa
}
//función del temporizador
function tiempo() {
    actual = new Date(); //fecha a cada instante
    //tiempo del crono (cro) = fecha instante (actual) - fecha inicial (emp)
    cro = actual - emp; //milisegundos transcurridos.
    cr = new Date(); //pasamos el num. de milisegundos a objeto fecha.
    cr.setTime(cro);
    //obtener los distintos formatos de la fecha:
    cs = cr.getMilliseconds(); //milisegundos
    cs = cs / 10; //paso a centésimas de segundo.
    cs = Math.round(cs); //redondear las centésimas
    sg = cr.getSeconds(); //segundos
    mn = cr.getMinutes(); //minutos
    //poner siempre 2 cifras en los números
    if (cs < 10) {
        cs = "0" + cs;
    }
    if (sg < 10) {
        sg = "0" + sg;
    }
    if (mn < 10) {
        mn = "0" + mn;
    }
    //llevar resultado al visor.
    visor.innerHTML = mn + " " + sg + " " + cs;
}
//parar el cronómetro
function parar() {
    clearInterval(elcrono); //parar el crono
    marcha = 0; //indicar que está parado.
    //document.cron.boton2.value = "Continuar"; //cambiar el estado del botón
}
//Continuar una cuenta empezada y parada.
function continuar() {
    emp2 = new Date(); //fecha actual
    emp2 = emp2.getTime(); //pasar a tiempo Unix
    emp3 = emp2 - cro; //restar tiempo anterior
    emp = new Date(); //nueva fecha inicial para pasar al temporizador
    emp.setTime(emp3); //datos para nueva fecha inicial.
    elcrono = setInterval(tiempo, 10); //activar temporizador
    marcha = 1; //indicar que esta en marcha
    //document.cron.boton2.value = "parar"; //Cambiar estado del botón
    //document.cron.boton1.disabled = false; //activar boton 1 si estuviera desactivado
}
//Volver al estado inicial
function reiniciar() {
    if (marcha == 1) {
        //si el cronómetro está en marcha:
        clearInterval(elcrono); //parar el crono
        marcha = 0; //indicar que está parado
    }
    //en cualquier caso volvemos a los valores iniciales
    cro = 0; //tiempo transcurrido a cero
    visor.innerHTML = "00 00 00"; //visor a cero
    //document.cron.boton1.value = "Empezar"; //estado inicial primer botón
    //document.cron.boton2.value = "Parar"; //estado inicial segundo botón
    //document.cron.boton2.disabled = true;  //segundo botón desactivado
}
