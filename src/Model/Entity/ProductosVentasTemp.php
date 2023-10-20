<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductosVentasTemp Entity
 *
 * @property int $idproductos_ventas_temp
 * @property int $productos_idproductos
 * @property int $ventas_idventas_temp
 * @property int $cantidad
 * @property float $precio_unidad
 * @property float|null $descuento_unidad
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class ProductosVentasTemp extends Entity
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
        'ventas_idventas_temp' => true,
        'cantidad' => true,
        'precio_unidad' => true,
        'descuento_unidad' => true,
        'created' => true,
        'modified' => true,
    ];
}
