//constantes para el funcionamiento del juego
//corriendo el juego
const STATE_RUNNING = 1;
//juego perdido
const STATE_LOSING = 2;
//intervalos de tiempo, velociad de la serpiente
const TICK = 60;
//tamaño de cada uno de los cuadros
const SQUARE_SIZE = 10;
//alto y ancho de nuestro campo de juego
const BOARD_WIDTH = 40;
const BOARD_HEIGHT = 40;
//lo que crecera la serpiente
const GROW_SCALE = 10;
//mapa de teclas del teclado para determinar una direccion primer valor desplazamiento en x segundo en y
const DIRECTIONS_MAP = {
    'A': [-1, 0],
    'D': [1, 0],
    'S': [0, 1],
    'W': [0, -1],
    'a': [-1, 0],
    'd': [1, 0],
    's': [0, 1],
    'w': [0, -1]
};
//puntuacion
var score = -1;
//logica del juego
let state = {
    //referencia del elemento html
    canvas: null,
    //derivado de la variable canvas
    context: null,
    //posiciones de la serpiente
    snake: [{ x: 0, y: 0 }],
    //para saber la dirección de la serpiente
    direction: { x: 1, y: 0 },
    //posicion de la presa
    prey: { x: 0, y: 0 },
    //cuantos cuadros hay pendientes de crecer
    growing: 0,
    //estado del juego
    runState: STATE_RUNNING
};
//generar posiciones aleatorias
function randomXY() {
    return {
        x: parseInt(Math.random() * BOARD_WIDTH),
        y: parseInt(Math.random() * BOARD_HEIGHT)
    };
}

function tick() {
    const head = state.snake[0];
    const tail = {};
    const dx = state.direction.x;
    const dy = state.direction.y;
    const highestIndex = state.snake.length - 1;
    let interval = TICK;
    Object.assign(tail, state.snake[state.snake.length - 1]);
    let didScore = (
        head.x === state.prey.x && head.y === state.prey.y
    );
    if (state.runState === STATE_RUNNING) {
        for (let i = highestIndex; i > -1; i--) {
            const sq = state.snake[i];

            if (i === 0) {
                sq.x += dx;
                sq.y += dy;
            } else {
                sq.x = state.snake[i - 1].x;
                sq.y = state.snake[i - 1].y;
            }
        }
    } else if (state.runState === STATE_LOSING) {
        interval = 10;

        if (state.snake.length > 0) {
            state.snake.splice(0, 1);
        }
        if (state.snake.length === 0) {
            state.runState = STATE_RUNNING;
            state.snake.push(randomXY());
            state.prey = randomXY();
        }
    }
    if (detectCollision()) {
        state.runState = STATE_LOSING;
        state.growing = 0;
        stopGame();
    }
    if (didScore) {
        state.growing += GROW_SCALE;
        state.prey = randomXY();
        score++;
    }
    if (state.growing > 0) {
        state.snake.push(tail);
        state.growing -= 1;
    }
    requestAnimationFrame(draw);
    setTimeout(tick, interval);
}
function startGame() {
    state.canvas = document.querySelector('canvas');
    state.context = state.canvas.getContext('2d');
    window.onkeydown = function (e) {
        const direction = DIRECTIONS_MAP[e.key];
        if (direction) {
            const [x, y] = direction;
            if (-x !== state.direction.x && -y !== state.direction.y) {
                state.direction.x = x;
                state.direction.y = y;
            }
        }
    }
    tick();
}
//detectar si la serpiente ha colisionado
function detectCollision() {
    const head = state.snake[0];
    if (head.x < 0 || head.x >= BOARD_HEIGHT || head.y >= BOARD_WIDTH || head.y < 0) {
        return true;
    }
    for (var i = 1; i < state.snake.length; i++) {
        const sq = state.snake[i];
        if (sq.x === head.x && sq.y === head.y) {
            return true;
        }
    }
    return false;
}
//se encargara de dibujar los pixeles que componen la serpiente
function drawPixel(color, x, y) {
    state.context.fillStyle = color;
    state.context.fillRect(
        x * SQUARE_SIZE,
        y * SQUARE_SIZE,
        SQUARE_SIZE,
        SQUARE_SIZE
    );
}
function draw() {
    state.context.clearRect(0, 0, 400, 400);
    for (let i = 0; i < state.snake.length; i++) {
        const { x, y } = state.snake[i];
        drawPixel('#22dd22', x, y);
    }
    //dibujar presa
    const { x, y } = state.prey;
    drawPixel('yellow', x, y);
}
function stopGame() {
    //alert(`Tu puntuación ha sido de: ${score}`);
    var mensaje = confirm(`Tu puntuación ha sido de: ${score}, deseas guardarlo?`);
    if (mensaje) {
        guardarPuntuacion(score);
        score = 0;
    }
    //togglePopup(score);
    score = 0;
    die();
}
function quitarResul() {
    $('#resul').hide();
}