<?php

/* Inicializacion de variables */

/** Monto total de ventas de ticket en funcion de cada mes */
$tickets = [
    2000,
    5500,
    3500,
    7600,
    3200,
    9700,
    6400,
    4300,
    2300,
    7000,
    1200,
    12000,
];

$juegoMasVendido = [
    ['juego' => 'Autitos Chocadores', 'precioTicket' => 75, 'cantTickets' => 45],
    ['juego' => 'Montaña Rusa', 'precioTicket' => 110.5, 'cantTickets' => 194],
    ['juego' => 'Gusano Loco', 'precioTicket' => 42, 'cantTickets' => 34],
    ['juego' => 'Juego de la tazas', 'precioTicket' => 33, 'cantTickets' => 98],
    ['juego' => 'Barco Fantasma', 'precioTicket' => 53, 'cantTickets' => 76],
    ['juego' => 'Montaña de Agua', 'precioTicket' => 78, 'cantTickets' => 49],
    ['juego' => 'Sillas giratorias', 'precioTicket' => 80.5, 'cantTickets' => 87],
    ['juego' => 'Auto Loco', 'precioTicket' => 34, 'cantTickets' => 102],
    ['juego' => 'Cueva del terror', 'precioTicket' => 28, 'cantTickets' => 122],
    ['juego' => 'Montaña Rusa Invertida', 'precioTicket' => 112.5, 'cantTickets' => 156],
    ['juego' => 'Teatro', 'precioTicket' => 78.5, 'cantTickets' => 45],
    ['juego' => 'Karting', 'precioTicket' => 102, 'cantTickets' => 106],
];
menu();
/**
 * Inicializa el Menu de opciones
 *
 * @return void
 */
function menu()
{
    echo "Ingresa una opcion: \n";
    echo "#########################################################\n";
    echo "[1] - Ingresar una venta\n";
    echo "[2] - Mes con mayor monto de ventas\n";
    echo "[3] - Primer mes que supera un monto de ventas\n";
    echo "[4] - Información de un mes\n";
    echo "[5] - Juegos más vendidos Ordenados\n";
    echo "[0] - Salir\n";
    echo "#########################################################\n\n";

    /** Esperamos que ingrese una opcion */
    fscanf(STDIN, "%d", $op);

    switch ($op) {
        case 1:
            echo "#########################################################\n";
            echo "AGREGAR VENTA\n";

            /* Control de ingreso del mes */
            do {
                $mes = readline("Ingrese un mes: ");
                $indice = mesAIndice($mes);

                $eval = $indice == -1;
                if ($eval) echo "Valor Incorrecto, debe ingresar un mes correspondiente\n";
            } while ($eval);

            $juego = readline("Ingrese nombre del juego: ");

            /* Control de ingreso del precio */
            do {
                $precio = readline("Ingrese el precio: ");

                $eval = $precio < 0 || !is_numeric($precio);
                if ($eval) echo "Valor Incorrecto, debe ingresar un numero mayor o igual a 0\n";
            } while ($eval);

            /* Control de ingreso del precio */
            do {
                $cant = readline("Ingrese la cantidad de tickets, valor entero: ");

                $eval = $cant < 0 || !is_numeric($cant);
                if ($eval) echo "Valor Incorrecto, debe ingresar un numero mayor o igual a 0, no decimal\n";
            } while ($eval);

            agregarVenta((int) $mes, $juego, $precio, (int) $cant);

            break;
        case 2:
            echo 'opcion 2';
            break;
        case 3:
            echo 'opcion 3';
            break;
        case 4:
            echo 'opcion 4';
            break;
        case 5:
            echo 'opcion 5';
            break;
        case 0:
            echo ':)';
            break;

        default:
            echo 'No existe la opcion seleccionada\n\n';
            break;
    }

    /** Mostramos nuevamente el menu si no selecciono la opcion 0 */
    if ($op != 0) menu();
}

/**
 * 
 * 
 * @param String mes The month of the sale.
 * @param String juego The name of the game.
 * @param int precio The price of the game.
 * @param int cantTks The number of tickets sold
 * 
 * @return void
 */
function agregarVenta(int $mes, String $juego, float $precio, int $cantTks)
{

    echo "$mes\n";
    echo "$juego\n";
    echo "$precio\n";
    echo "$cantTks\n";
}


/**
 * 
 * 
 * @param String mes The month you want to convert to an index.
 */
function mesAIndice(String $mes)
{
    $mes = strtolower($mes);

    switch ($mes) {
        case 'enero':
            $indice = 0;
            break;
        case 'febrero':
            $indice = 1;
            break;
        case 'marzo':
            $indice = 2;
            break;
        case 'abril':
            $indice = 3;
            break;
        case 'mayo':
            $indice = 4;
            break;
        case 'junio':
            $indice = 5;
            break;
        case 'julio':
            $indice = 6;
            break;
        case 'agosto':
            $indice = 7;
            break;
        case 'septiembre':
            $indice = 8;
            break;
        case 'octubre':
            $indice = 9;
            break;
        case 'novimebre':
            $indice = 10;
            break;
        case 'diciembre':
            $indice = 11;
            break;

        default:
            /** Valor incorrecto */
            $indice = -1;
            break;
    }

    return $indice;
}
