<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pedido Entity
 *
 * @property int $idpedidos
 * @property int $number
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string $status
 * @property int $users_idusers
 * @property int $clientes_idclientes
 * @property float|null $subtotal
 * @property float|null $descuentos
 * @property float|null $total
 * @property float|null $descuento_general
 * @property string $hash
 * @property string|null $observaciones
 * @property int $assign
 * @property int|null $empleado_idempleado
 * @property int|null $status_val
 *
 * @property \App\Model\Entity\Producto[] $productos
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\User $Empleado
 */
class Pedido extends Entity
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
        'number' => true,
        'created' => true,
        'modified' => true,
        'status' => true,
        'users_idusers' => true,
        'clientes_idclientes' => true,
        'subtotal' => true,
        'descuentos' => true,
        'total' => true,
        'descuento_general' => true,
        'hash' => true,
        'observaciones' => true,
        'assign' => true,
        'empleado_idempleado' => true,
        'status_val' => true,
        'productos' => true,
        'cliente' => true,
        'Empleado' => true,
    ];
}
