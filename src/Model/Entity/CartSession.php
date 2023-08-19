<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CartSession Entity
 *
 * @property int $idcart_session
 * @property int $productos_idproductos
 * @property int $users_idusers
 *
 * @property \App\Model\Entity\Producto $producto
 */
class CartSession extends Entity
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
        'users_idusers' => true,
        'producto' => true,
    ];
}
