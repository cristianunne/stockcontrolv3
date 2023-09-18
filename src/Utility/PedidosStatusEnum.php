<?php

namespace App\Utility;
class PedidosStatusEnum extends BasicEnum{

    const ORDER = 'Pedido';
    const PROCESSING = 'Procesando';
    const COMPLETED = 'Completado';
    const CANCEL = 'Cancelado';

    const DISTRIBUTION = 'En Distribución';
}
