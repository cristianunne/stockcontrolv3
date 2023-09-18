<?php

namespace App\Utility;

use App\Utility\BasicEnum;

class StockEventsEnum extends BasicEnum
{

    const MANUAL = 'Manual';
    const COMPRAS = 'Compras';

    const VENTAS = 'Ventas';

    const DEVOLUCIONES = 'Devoluciones';

    const BAJAS = 'Bajas';
}


class StockBajasEnum extends BasicEnum
{
    const VENCIMIENTO = 'Vencimiento';
    const PERDIDA = 'Perdida';
    const ROTURA = 'Rotura';
    const OTROS = 'Otros';

}