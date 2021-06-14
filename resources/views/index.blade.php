@extends('layouts.app')
@section('content')
<main class="main">
        <div class="container">
            <div id="buscaminas">
                <h2>
                    <a href="{{ url('/login') }}">Jugar al Buscaminas</a> <img class="minita" src="../resources/img/minita.png"
                        alt="imagen de una mina del buscaminas">
                </h2>
                <p><a href="{{ url('/login') }}">Buscaminas</a> (nombre original en inglés: Minesweeper) es un videojuego para un jugador
                    inventado por
                    Robert Donner en 1989. El objetivo del juego es despejar un campo de minas sin detonar ninguna.

                    El juego ha sido programado para muchos sistemas operativos, pero debe su popularidad a las
                    versiones que vienen con Microsoft Windows desde su versión 3.1.

                </p>
                    <img class="img-fluid" width="400px" src="../resources/img/buscaminas.png" alt="imagen de un buscaminas">

                <p>El juego consiste en despejar todas las casillas de una pantalla que no oculten una mina.

                    Algunas casillas tienen un número, el cual indica la cantidad de minas que hay en las casillas
                    circundantes. Así, si una casilla tiene el número 3, significa que de las ocho casillas que hay
                    alrededor (si no es en una esquina o borde) hay 3 con minas y 5 sin minas. Si se descubre una
                    casilla sin número indica que ninguna de las casillas vecinas tiene mina y éstas se descubren
                    automáticamente.

                    Si se descubre una casilla con una mina se pierde la partida.

                    Se puede poner una marca en las casillas que el jugador piensa que hay minas para ayudar a descubrir
                    las que están cerca.</p>
                <p>El juego también posee un sistema de récords para cada uno de los 4 niveles en el que se indica el
                    menor tiempo en terminar el juego. Los niveles son (para las nuevas versiones):

                    Nivel principiante: 8 × 8 casillas y 10 minas.
                    Nivel intermedio: 16 × 16 casillas y 40 minas.
                    Nivel experto: 16 × 30 casillas y 99 minas.
                    Nivel personalizado: en este caso el usuario personaliza su juego eligiendo el número de minas y el
                    tamaño de la cuadrícula.
                    En versiones anteriores a Windows 2000 la pantalla en nivel principiante sólo mide 8 × 8, y fue
                    agrandada para evitar que la probabilidad de hacer clic en una mina fuera la misma que en el nivel
                    intermedio: 10/(8×8) = 10/64 = 40/256 = 40/(16×16) ​También se puede personalizar la dificultad de
                    juego según el tamaño de la pantalla y el número de minas.

                    En Windows XP el buscaminas tiene sonido. En Windows Vista se elimina la carita feliz que venía
                    apareciendo en versiones anteriores de Windows; además, agrega nuevos efectos y la posibilidad de
                    cambiar las minas por flores.</p>
            </>
            <div id="snake-post">
                <h2><a href="{{ url('/login') }}">Jugar al Snake</a> <img class="serp" src="../resources/img/serpp.png" alt="serpiente del juego snake"></h2>
                <p>El <a href="{{ url('/login') }}">Snake</a> (a veces también llamado la serpiente) es un videojuego lanzado a mediados
                    de la década de
                    1970 que ha mantenido su popularidad desde entonces, convirtiéndose en un clásico. En 1998, el Snake
                    obtuvo una audiencia masiva tras convertirse en un juego estándar pre-grabado en los teléfonos
                    Nokia.</p>
                <p>En el juego, el jugador o usuario controla una larga y delgada criatura, semejante a una serpiente,
                    que vaga alrededor de un plano delimitado, recogiendo alimentos (o algún otro elemento), tratando de
                    evitar golpear a su propia cola o las "paredes" que rodean el área de juego. Cada vez que la
                    serpiente se come un pedazo de comida, la cola crece más, provocando que aumente la dificultad del
                    juego. El usuario controla la dirección de la cabeza de la serpiente (arriba, abajo, izquierda o
                    derecha) y el cuerpo de la serpiente la sigue. Además, el jugador no puede detener el movimiento de
                    la serpiente, mientras que el juego está en marcha.</p>
            </div>
        </div>



    </main>

    <footer class="footer">
        <div class="contanier">
            <p><a class="menu-link" href="https://github.com/adriansalo9">Página diseñada por Adrián Saló</a></p>
        </div>
    </footer>
@endsection