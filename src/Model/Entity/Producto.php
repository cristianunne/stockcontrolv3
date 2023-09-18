<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Producto Entity
 *
 * @property int $idproductos
 * @property string $name
 * @property string|null $marca
 * @property string|null $unidad
 * @property float $content
 * @property string|null $description
 * @property int|null $subcategories_idsubcategories
 * @property bool $active
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $categories_idcategories
 * @property int|null $proveedores_idproveedores
 * @property string|null $image
 *
 * @property \App\Model\Entity\Subcategory $subcategory
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Precio[] $precios
 * @property \App\Model\Entity\Descuento[] $descuentos
 * @property \App\Model\Entity\CartSession[] $cart_session
 * @property \App\Model\Entity\Pedido[] $pedidos
 * @property \App\Model\Entity\Proveedore $proveedore
 */
class Producto extends Entity
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
        'name' => true,
        'marca' => true,
        'unidad' => true,
        'content' => true,
        'description' => true,
        'subcategories_idsubcategories' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'categories_idcategories' => true,
        'proveedores_idproveedores' => true,
        'image' => true,
        'subcategory' => true,
        'category' => true,
        'precios' => true,
        'descuentos' => true,
        'cart_session' => true,
        'pedidos' => true,
        'proveedore' => true,
        'stock_producto' => true,
    ];
}
