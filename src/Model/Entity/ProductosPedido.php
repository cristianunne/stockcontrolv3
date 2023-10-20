<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductosPedido Entity
 *
 * @property int $idproductos_pedidos
 * @property int $productos_idproductos
 * @property int $pedidos_idpedidos
 * @property int $cantidad
 * @property float $precio_unidad
 * @property float|null $descuento_unidad
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class ProductosPedido extends Entity
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
        'pedidos_idpedidos' => true,
        'cantidad' => true,
        'precio_unidad' => true,
        'descuento_unidad' => true,
        'created' => true,
        'modified' => true,
    ];
}
