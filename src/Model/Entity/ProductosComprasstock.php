<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductosComprasstock Entity
 *
 * @property int $idproductos_comprasstock
 * @property int $productos_idproductos
 * @property int $comprasstock_idcomprasstock
 * @property int|null $cantidad
 * @property float|null $precio_unidad
 * @property string|null $descuento_unidad
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $comprobante
 * @property int|null $status
 * @property string|null $observaciones
 * @property int|null $is_stock
 * @property int|null $cantidad_pedido
 */
class ProductosComprasstock extends Entity
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
        'productos_idproductos' => true,
        'comprasstock_idcomprasstock' => true,
        'cantidad' => true,
        'precio_unidad' => true,
        'descuento_unidad' => true,
        'created' => true,
        'modified' => true,
        'comprobante' => true,
        'status' => true,
        'observaciones' => true,
        'is_stock' => true,
        'cantidad_pedido' => true,
    ];
}
