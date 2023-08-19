<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Precio Entity
 *
 * @property int $idprecios
 * @property float|null $precio
 * @property float|null $descuento
 * @property \Cake\I18n\FrozenTime|null $created
 * @property int $active
 * @property int $productos_idproductos
 */
class Precio extends Entity
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
        'precio' => true,
        'descuento' => true,
        'created' => true,
        'active' => true,
        'productos_idproductos' => true,
    ];
}
