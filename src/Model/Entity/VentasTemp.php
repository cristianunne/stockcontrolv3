<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VentasTemp Entity
 *
 * @property int $idventas
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $users_idusers
 * @property int $clientes_idclientes
 * @property float|null $subtotal
 * @property float|null $descuentos
 * @property float|null $total
 * @property float|null $descuento_general
 * @property string $hash
 * @property int|null $pedidos_idpedidos
 * @property string|null $coordenadas
 * @property int|null $campaign_idcampaign
 * @property int|null $status
 * @property int $cuenta_corriente
 * @property int|null $is_pay
 * @property int|null $camion_idcamion
 *
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Producto[] $productos
 * @property \App\Model\Entity\ProductosVentasTemp[] $productos_ventas_temp
 */
class VentasTemp extends Entity
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
        'campaign_idcampaign' => true,
        'status' => true,
        'cuenta_corriente' => true,
        'is_pay' => true,
        'camion_idcamion' => true,
        'cliente' => true,
        'user' => true,
        'productos' => true,
        'productos_ventas_temp' => true,
    ];
}
