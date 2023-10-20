<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockCamionCampaign Entity
 *
 * @property int $idstock_camion_campaign
 * @property int $campaign_idcampaign
 * @property int $camion_idcamion
 * @property int $users_idusers
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class StockCamionCampaign extends Entity
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
        'campaign_idcampaign' => true,
        'camion_idcamion' => true,
        'users_idusers' => true,
        'created' => true,
        'modified' => true,
    ];
}
