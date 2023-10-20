<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersSession Entity
 *
 * @property int $idusers_session
 * @property int $users_idusers
 * @property string $api_key
 * @property \Cake\I18n\FrozenTime|null $created
 */
class UsersSession extends Entity
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
        'users_idusers' => true,
        'api_key' => true,
        'created' => true,
    ];
}
