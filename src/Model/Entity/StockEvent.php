<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockEvent Entity
 *
 * @property int $idstock_events
 * @property string $categoria
 * @property \Cake\I18n\FrozenTime|null $created
 * @property int $cantidad
 * @property string|null $observaciones
 * @property int $stockproductos_id
 * @property string|null $categoria_baja
 * @property int|null $comprasstock_id
 *
 * @property \App\Model\Entity\StockProducto $stock_producto
 * @property \App\Model\Entity\ComprasStock $compras_stock
 */
class StockEvent extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'categoria' => true,
        'created' => true,
        'cantidad' => true,
        'observaciones' => true,
        'stockproductos_id' => true,
        'categoria_baja' => true,
        'comprasstock_id' => true,
        'stock_producto' => true,
        'compras_stock' => true,
    ];
}
