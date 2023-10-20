<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Proveedore Entity
 *
 * @property int $idproveedores
 * @property string $name
 * @property string|null $cuit
 * @property string|null $direccion
 * @property string|null $provincia
 * @property string|null $localidad
 * @property string|null $telefono
 * @property string|null $email
 * @property string|null $departamento
 */
class Proveedore extends Entity
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
        'cuit' => true,
        'direccion' => true,
        'provincia' => true,
        'localidad' => true,
        'telefono' => true,
        'email' => true,
        'departamento' => true,
    ];
}
