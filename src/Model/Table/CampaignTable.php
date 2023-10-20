<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Campaign Model
 *
 * @method \App\Model\Entity\Campaign newEmptyEntity()
 * @method \App\Model\Entity\Campaign newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Campaign[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Campaign get($primaryKey, $options = [])
 * @method \App\Model\Entity\Campaign findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Campaign patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Campaign[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Campaign|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Campaign saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Campaign[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Campaign[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Campaign[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Campaign[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CampaignTable extends Table
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

        $this->setTable('campaign');
        $this->setDisplayField('idcampaign');
        $this->setPrimaryKey('idcampaign');

        $this->addBehavior('Timestamp');

        $this->hasMany('StockCamionCampaign', [
            'foreignKey' => 'campaign_idcampaign',
            'bindingKey' => 'idcampaign', //actual
            'joinType' => 'INNER'
        ]);

        $this->hasMany('VentasTemp', [
            'foreignKey' => 'campaign_idcampaign',
            'bindingKey' => 'idcampaign', //actual
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Ventas', [
            'foreignKey' => 'campaign_idcampaign',
            'bindingKey' => 'idcampaign', //actual
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
            ->integer('number')
            ->requirePresence('number', 'create')
            ->notEmptyString('number');

        $validator
            ->dateTime('fecha_inicio')
            ->requirePresence('fecha_inicio', 'create')
            ->notEmptyDateTime('fecha_inicio');

        $validator
            ->dateTime('fecha_fin')
            ->requirePresence('fecha_fin', 'create')
            ->notEmptyDateTime('fecha_fin');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 500)
            ->allowEmptyString('descripcion');

        $validator
            ->dateTime('finished')
            ->allowEmptyDateTime('finished');

        $validator
            ->notEmptyString('status');

        return $validator;
    }
}
