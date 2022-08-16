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
    echo "#########################################################\n\n";
}
