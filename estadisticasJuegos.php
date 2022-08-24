<?php

/** Listado de juegos dentro del parque con su correspondiente precio actual */
$juegos = [
    ['juego' => 'Autitos Chocadores', 'precioTicket' => 75],
    ['juego' => 'Montaña Rusa', 'precioTicket' => 110.5],
    ['juego' => 'Gusano Loco', 'precioTicket' => 42],
    ['juego' => 'Juego de la tazas', 'precioTicket' => 33],
    ['juego' => 'Barco Fantasma', 'precioTicket' => 53],
    ['juego' => 'Montaña de Agua', 'precioTicket' => 78],
    ['juego' => 'Sillas giratorias', 'precioTicket' => 80.5],
    ['juego' => 'Auto Loco', 'precioTicket' => 34],
    ['juego' => 'Cueva del terror', 'precioTicket' => 28],
    ['juego' => 'Montaña Rusa Invertida', 'precioTicket' => 112.5],
    ['juego' => 'Teatro', 'precioTicket' => 78.5],
    ['juego' => 'Karting', 'precioTicket' => 102],
];

/**
 * Genera la estrutura de datos inicial de $juegosMasVendidos.
 * La cantidad de tk la genera con la funcion rand() de php
 * 
 * @param Array $juegos arreglo de juegos.
 * 
 * @return Array listado generado
 */
function precargaJuegosMasVendidos(array $juegos)
{
    $juegoMasVendido = [];

    foreach ($juegos as $juego) {
        $rand =  rand(49, 120);
        $juegoMasVendido[] = [
            'juego' => $juego['juego'],
            'precioTicket' => $juego['precioTicket'],
            'cantTickets' => rand(49, 120),
            'total' => $rand * $juego['precioTicket']
        ];
    }

    return $juegoMasVendido;
}

/**
 * It takes an array of arrays, and returns an array of the product of the values of the 'precioTicket'
 * and 'cantTickets' keys of each sub-array
 * 
 * @param array juegoMasVendido array of arrays, each array has the following keys:
 * 
 * @return array array of the total amount of tickets sold for each game.
 */
function precargaMontoTotalTks(array $juegoMasVendido)
{
    $tickets = [];

    foreach ($juegoMasVendido as $juego) {
        $tickets[] = $juego['precioTicket'] * $juego['cantTickets'];
    }

    return $tickets;
}

$juegoMasVendido = precargaJuegosMasVendidos($juegos);
$tickets = precargaMontoTotalTks($juegoMasVendido);

/** Inicio del sistema */
menuOpciones($juegoMasVendido, $tickets);

/**
 * Menu de opciones
 *
 * @return void
 */
function menuOpciones(array $juegoMasVendido, array $tickets)
{
    switch ($op = printOpciones()) {
        case "1":
            $arregloVenta = agregarVenta(
                /* Solicitamos el mes */
                solicitarMes(),

                /* Solicitamos el nombre del juego */
                readline("Ingrese nombre del juego: "),

                /* Solicitamos el precio por tk */
                solicitarPrecio(),

                /* Solicitamos la cantidad de tks */
                solicitarCantTks(),

                $juegoMasVendido,

                $tickets
            );

            $juegoMasVendido = $arregloVenta[0];
            $tickets = $arregloVenta[1];

            break;
        case "2":
            mesMayorVenta($juegoMasVendido, $tickets);
            break;
        case "3":
            mesSuperaMontoVentas(solicitarMonto(), $tickets, $juegoMasVendido);
            break;
        case "4":
            informacionMes(solicitarMes(), $juegoMasVendido, $tickets);
            break;
        case "5":
            masVendidoOrdenado($juegoMasVendido);
            break;
        case "0":
            echo ':)';
            break;

        default:
            echo "No existe la opcion seleccionada\n\n";
            break;
    }

    /** Mostramos nuevamente el menu si no selecciono la opcion 0 */
    if ($op != "0") menuOpciones($juegoMasVendido, $tickets);
}

/**
 * Genera una venta
 * 
 * @param int $mes 
 * @param String $juego nombre del juego
 * @param float $precio precio del juego
 * @param int $cantTks cantidad de tks que se vendieron 
 * @param array $juegoMasVendido arreglo de juegos mas vendidos
 * @param array $tickets monto total de venta de todos los meses
 * 
 * @return void
 */
function agregarVenta(int $mes, String $juego, float $precio, int $cantTks, array $juegoMasVendido, array $tickets)
{
    /* Calculamos el monto total de la venta */
    $montoTotalVenta = $precio * $cantTks;

    if ($tickets[$mes] <= $montoTotalVenta) {
        $juegoMasVendido[$mes] = [
            'juego' => $juego,
            'precioTicket' => $precio,
            'cantTickets' => $cantTks
        ];
    }

    $tickets[$mes] += $montoTotalVenta;

    return [
        $juegoMasVendido,
        $tickets,
    ];
}

/**
 * Muestra por pantalla el detalle completo del mes con mayor ventas
 * 
 * @param array $juegoMasVendido arreglo de juegos mas vendidos
 * @param array $tickets monto total de venta de todos los meses
 * 
 * @return void
 */
function mesMayorVenta(array $juegoMasVendido, array $tickets)
{
    /* Obtenemos el monto maximo de los tks vendidos */
    $montoMaximo = max($tickets);

    /* Obtenemos el mes (posicion del arreglo) que corresponde al monto maximo */
    $mesInt = array_search($montoMaximo, $tickets);

    /* Obtenemos el detalle del juego mas vendido */
    $juegoMasVendido = $juegoMasVendido[$mesInt];

    /* Mostramos por pantalla la informacion completa del mes */
    printDetalleMes($mesInt, $juegoMasVendido, $tickets);
}

function informacionMes(int $mes, array $juegoMasVendido, array $tickets)
{
    printDetalleMes($mes, $juegoMasVendido[$mes], $tickets);
}

/**
 * It filters the array of tickets to get the first one that is greater than the given amount, then it
 * gets the index of that ticket in the array, and finally it prints the information of the month that
 * corresponds to that index
 * 
 * @param float $monto el monto que se va a comprar
 * @param array $tickets monto total de venta de todos los meses
 * @param array $juegoMasVendido arreglo de juegos mas vendidos
 * 
 * @return void
 */
function mesSuperaMontoVentas(float $monto, array $tickets, array $juegoMasVendido)
{
    /* Obtenemos todos los de tickets superiores a $monto */
    $primerMontoMayor = array_filter($tickets, function ($tk) use ($monto) {
        return $tk > $monto;
    });

    /* obtemeos el primero elemento de lo filtrado */
    $primerMontoMayor = current($primerMontoMayor);

    /* Verificamos que obtuvimos un resultado */
    if ($primerMontoMayor) {
        /* Obtenemos el mes en formato numerico */
        $indiceMesMontoMayor = array_search($primerMontoMayor, $tickets);

        /* mostramos la informacion por pantalla */
        printDetalleMes($indiceMesMontoMayor, $juegoMasVendido[$indiceMesMontoMayor], $tickets);
    } else {
        echo 'No se encontro información';
    }
}

/**
 * Imprime los juegos mas vendidos ordenados 
 * en funcion del monto total (precioTicket * cantidadTicket) 
 * de menor a mayor
 * 
 * @param array $juegoMasVendido arreglo de juegos mas vendidos
 * 
 * @return void 
 */
function masVendidoOrdenado(array $juegoMasVendido)
{
    usort($juegoMasVendido, function ($a, $b) {
        return $a['precioTicket'] * $a['cantTickets'] > $b['precioTicket'] * $b['cantTickets'];
    });

    /**  Imprime información legible para humanos sobre una variable primitivas, objetos e instancias de clases */
    print_r($juegoMasVendido);
}

/**
 * Muestra por pantalla el detalle completo del mes
 * 
 * @param int $mes 
 * @param array $juegoMasVendido arreglo de juegos mas vendidos
 * @param array $tickets monto total de venta de todos los meses
 * 
 * @return void
 */
function printDetalleMes(int $mes, array $juegoMayorVentas, array $tickets)
{
    $juego = $juegoMayorVentas['juego'];
    $cantTickets = $juegoMayorVentas['cantTickets'];
    $precioTicket = $juegoMayorVentas['precioTicket'];

    $montoTotalJuego = $cantTickets * $precioTicket;
    $mesString = indiceAMes($mes);
    $montoTotalMes = $tickets[$mes];

    echo "#########################################################\n";
    echo "<$mesString>\n";
    echo "Monto total de ventas del mes $mesString: $$montoTotalMes\n";
    echo "El juego con mayor monto de venta: $juego\n";
    echo "Numero de Tickets del juego mas vendido: $cantTickets\n";
    echo "Venta total del juego mas vendido:  $$montoTotalJuego\n";
    echo "#########################################################\n\n";
}

/**
 * Solicita al usuario que ingrese un mes en formato texto que sea valido
 * 
 * @return int $indiceMes.
 */
function solicitarMes()
{
    $indiceMes = -1;

    do {
        $mes = readline("Ingrese un mes: ");
        $indiceMes = mesAIndice($mes);

        $eval = $indiceMes == -1;
        if ($eval) echo "Valor Incorrecto, debe ingresar un mes correspondiente\n";
    } while ($eval);

    return (int) $indiceMes;
}

/**
 * Solicita al usuario que ingrese un el precio por tk del juego
 * 
 * @return float $precio.
 */
function solicitarPrecio()
{
    $precio = -1;
    do {
        $precio = readline("Ingrese el precio: ");

        $eval = $precio < 0 || !is_numeric($precio);
        if ($eval) echo "Valor Incorrecto, debe ingresar un numero mayor o igual a 0\n";
    } while ($eval);

    return $precio;
}

/**
 * Solicita al usuario que ingrese la cantidad de tks vendidos
 * 
 * @return int $cant.
 */
function solicitarCantTks()
{
    $cant = -1;
    do {
        $cant = readline("Ingrese la cantidad de tickets, valor entero: ");

        $eval = $cant < 0 || !is_numeric($cant);
        if ($eval) echo "Valor Incorrecto, debe ingresar un numero mayor o igual a 0, no decimal\n";
    } while ($eval);

    return (int) $cant;
}

/**
 * Solicita al usuario que ingrese un el precio por tk del juego
 * 
 * @return float $precio.
 */
function solicitarMonto()
{
    $monto = -1;
    do {
        $monto = readline("Ingrese el monto: ");

        $eval = $monto < 0 || !is_numeric($monto);
        if ($eval) echo "Valor Incorrecto, debe ingresar un numero mayor o igual a 0\n";
    } while ($eval);

    return $monto;
}

/**
 * Obtenemos el mes (indice)
 * 
 * @param String $mes
 * @return $int
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

/**
 * Obtenemos el mes (string)
 * 
 * @param int $mes
 * @return $string
 */
function indiceAMes(int $mes)
{
    switch ($mes) {
        case 0:
            $string = 'enero';
            break;
        case 1:
            $string = 'febrero';
            break;
        case 2:
            $string = 'marzo';
            break;
        case 3:
            $string = 'abril';
            break;
        case 4:
            $string = 'mayo';
            break;
        case 5:
            $string = 'junio';
            break;
        case 6:
            $string = 'julio';
            break;
        case 7:
            $string = 'agosto';
            break;
        case 8:
            $string = 'septiembre';
            break;
        case 9:
            $string = 'octubre';
            break;
        case 10:
            $string = 'novimebre';
            break;
        case 11:
            $string = 'diciembre';
            break;

        default:
            /** Valor incorrecto */
            $string = -1;
            break;
    }

    return $string;
}

/**
 * Muestra por pantalla las opciones del menu
 * 
 * @return readline | funcion para poder leer los datos del usuario
 */
function printOpciones()
{
    echo "Ingresa una opcion: \n\n";
    echo "#########################################################\n";
    echo "[1] - Ingresar una venta\n";
    echo "[2] - Mes con mayor monto de ventas\n";
    echo "[3] - Primer mes que supera un monto de ventas\n";
    echo "[4] - Información de un mes\n";
    echo "[5] - Juegos más vendidos Ordenados\n";
    echo "[0] - Salir\n";
    echo "#########################################################\n\n";

    /** Esperamos que ingrese una opcion */
    return readline();
}
