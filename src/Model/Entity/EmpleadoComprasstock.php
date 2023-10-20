<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmpleadoComprasstock Entity
 *
 * @property int $idempleado_comprastock
 * @property int $comprasstock_idcomprasstock
 * @property int $productos_idproductos
 * @property int $cantidad
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $comprobante
 * @property int|null $users_idusers
 * @property int|null $status
 * @property string|null $observaciones
 *
 * @property \App\Model\Entity\User $Users
 * @property \App\Model\Entity\Producto $producto
 */
class EmpleadoComprasstock extends Entity
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
        'comprasstock_idcomprasstock' => true,
        'productos_idproductos' => true,
        'cantidad' => true,
        'created' => true,
        'modified' => true,
        'comprobante' => true,
        'users_idusers' => true,
        'status' => true,
        'observaciones' => true,
        'Users' => true,
        'producto' => true,
    ];
}
