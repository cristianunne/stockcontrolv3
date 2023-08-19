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
 * @property string|null $photo
 * @property string|null $folder
 * @property int|null $categories_idcategories
 *
 * @property \App\Model\Entity\Subcategory $subcategory
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
        'photo' => true,
        'folder' => true,
        'categories_idcategories' => true,
        'subcategory' => true,
    ];
}
