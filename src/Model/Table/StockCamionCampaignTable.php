<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockCamionCampaign Model
 *
 * @method \App\Model\Entity\StockCamionCampaign newEmptyEntity()
 * @method \App\Model\Entity\StockCamionCampaign newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\StockCamionCampaign[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockCamionCampaign get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockCamionCampaign findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\StockCamionCampaign patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockCamionCampaign[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockCamionCampaign|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockCamionCampaign saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockCamionCampaign[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StockCamionCampaign[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\StockCamionCampaign[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StockCamionCampaign[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StockCamionCampaignTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('stock_camion_campaign');
        $this->setDisplayField('idstock_camion_campaign');
        $this->setPrimaryKey('idstock_camion_campaign');

        $this->addBehavior('Timestamp');

        $this->hasOne('Users', [
            'className' => 'Users',
            'foreignKey' => 'idusers',
            'bindingKey' => 'users_idusers', //actual
            'joinType' => 'INNER'
        ]);

        $this->hasOne('Camiones', [
            'className' => 'Camiones',
            'foreignKey' => 'idcamiones',
            'bindingKey' => 'camion_idcamion', //actual
            'joinType' => 'INNER'
        ]);

        $this->hasMany('StockCampaignProducto', [
            'foreignKey' => 'stock_camion_campaign_idstock_camion_campaign',
            'bindingKey' => 'idstock_camion_campaign', //actual
            'joinType' => 'INNER'
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('campaign_idcampaign')
            ->requirePresence('campaign_idcampaign', 'create')
            ->notEmptyString('campaign_idcampaign');

        $validator
            ->integer('camion_idcamion')
            ->requirePresence('camion_idcamion', 'create')
            ->notEmptyString('camion_idcamion');

        $validator
            ->integer('users_idusers')
            ->requirePresence('users_idusers', 'create')
            ->notEmptyString('users_idusers');

        return $validator;
    }
}
