<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cliente Entity
 *
 * @property int $idclientes
 * @property string $nombre
 * @property string $apellido
 * @property string $dni
 * @property string $pais
 * @property string $provincia
 * @property string|null $departamento
 * @property string $localidad
 * @property string|null $direccion
 * @property string|null $altura
 * @property string $shop_name
 * @property string|null $observaciones
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $telefono
 */
class Cliente extends Entity
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
        'nombre' => true,
        'apellido' => true,
        'dni' => true,
        'pais' => true,
        'provincia' => true,
        'departamento' => true,
        'localidad' => true,
        'direccion' => true,
        'altura' => true,
        'shop_name' => true,
        'observaciones' => true,
        'created' => true,
        'modified' => true,
        'telefono' => true,
    ];
}
