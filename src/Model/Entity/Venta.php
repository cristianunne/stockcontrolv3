<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Venta Entity
 *
 * @property int $idventas
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $users_idusers
 * @property int $clientes_idclientes
 * @property float $subtotal
 * @property float $descuentos
 * @property float $total
 * @property float|null $descuento_general
 * @property string $hash
 * @property int|null $pedidos_idpedidos
 * @property string|null $coordenadas
 * @property int $number
 * @property int|null $campaign_idcampaign
 * @property int $cuenta_corriente
 * @property int $is_pay
 * @property int|null $camion_idcamion
 *
 * @property \App\Model\Entity\Producto[] $productos
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ProductosVenta[] $productos_ventas
 * @property \App\Model\Entity\Devolucione[] $devoluciones
 */
class Venta extends Entity
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
        'created' => true,
        'modified' => true,
        'users_idusers' => true,
        'clientes_idclientes' => true,
        'subtotal' => true,
        'descuentos' => true,
        'total' => true,
        'descuento_general' => true,
        'hash' => true,
        'pedidos_idpedidos' => true,
        'coordenadas' => true,
        'number' => true,
        'campaign_idcampaign' => true,
        'cuenta_corriente' => true,
        'is_pay' => true,
        'camion_idcamion' => true,
        'productos' => true,
        'cliente' => true,
        'user' => true,
        'productos_ventas' => true,
        'devoluciones' => true,
    ];
}
