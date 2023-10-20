<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ComprasStock Entity
 *
 * @property int $idcompras_stock
 * @property int $users_idusers
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $users_comprador
 * @property string|null $descripcion
 * @property int $status
 * @property \Cake\I18n\FrozenTime|null $finished
 * @property int|null $assign
 * @property int $is_closed
 * @property string|null $hash_control
 *
 * @property \App\Model\Entity\User $Users
 * @property \App\Model\Entity\User $UsersComprador
 * @property \App\Model\Entity\Producto[] $productos
 * @property \App\Model\Entity\EmpleadoComprasstock[] $empleado_comprasstock
 */
class ComprasStock extends Entity
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
        'users_idusers' => true,
        'created' => true,
        'modified' => true,
        'users_comprador' => true,
        'descripcion' => true,
        'status' => true,
        'finished' => true,
        'assign' => true,
        'is_closed' => true,
        'hash_control' => true,
        'Users' => true,
        'UsersComprador' => true,
        'productos' => true,
        'empleado_comprasstock' => true,
    ];
}
