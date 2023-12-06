<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Devolucione Entity
 *
 * @property int $iddevoluciones
 * @property int $ventas_idventas
 * @property int|null $productos_idproductos
 * @property int $cantidad
 * @property float $precio_unidad
 * @property float|null $descuento_unidad
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $users_idusers
 * @property int|null $id_productos_ventas
 * @property int|null $is_stock
 *
 * @property \App\Model\Entity\Venta $venta
 * @property \App\Model\Entity\Producto $producto
 * @property \App\Model\Entity\User $user
 */
class Devolucione extends Entity
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
        'ventas_idventas' => true,
        'productos_idproductos' => true,
        'cantidad' => true,
        'precio_unidad' => true,
        'descuento_unidad' => true,
        'created' => true,
        'modified' => true,
        'users_idusers' => true,
        'id_productos_ventas' => true,
        'is_stock' => true,
        'venta' => true,
        'producto' => true,
        'user' => true,
    ];
}
