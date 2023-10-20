<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockCampaignProducto Entity
 *
 * @property int $idstock_campaign_producto
 * @property int $stock_camion_campaign_idstock_camion_campaign
 * @property int $productos_idproductos
 * @property int $cantidad
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $cantidad_initial
 * @property int $status
 *
 * @property \App\Model\Entity\Producto $producto
 */
class StockCampaignProducto extends Entity
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
        'stock_camion_campaign_idstock_camion_campaign' => true,
        'productos_idproductos' => true,
        'cantidad' => true,
        'created' => true,
        'modified' => true,
        'cantidad_initial' => true,
        'status' => true,
        'producto' => true,
    ];
}
