<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockEvents Model
 *
 * @property \App\Model\Table\StockProductosTable&\Cake\ORM\Association\BelongsTo $StockProductos
 * @property \App\Model\Table\ComprasStockTable&\Cake\ORM\Association\BelongsTo $ComprasStock
 *
 * @method \App\Model\Entity\StockEvent newEmptyEntity()
 * @method \App\Model\Entity\StockEvent newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\StockEvent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockEvent get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockEvent findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\StockEvent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockEvent[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockEvent|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockEvent saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockEvent[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StockEvent[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\StockEvent[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StockEvent[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StockEventsTable extends Table
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

        $this->setTable('stock_events');
        $this->setDisplayField('idstock_events');
        $this->setPrimaryKey('idstock_events');

        $this->addBehavior('Timestamp');


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
            ->scalar('categoria')
            ->maxLength('categoria', 100)
            ->requirePresence('categoria', 'create')
            ->notEmptyString('categoria');

        $validator
            ->integer('cantidad')
            ->requirePresence('cantidad', 'create')
            ->notEmptyString('cantidad');

        $validator
            ->scalar('observaciones')
            ->maxLength('observaciones', 250)
            ->allowEmptyString('observaciones');

        $validator
            ->integer('stockproductos_id')
            ->notEmptyString('stockproductos_id');

        $validator
            ->scalar('categoria_baja')
            ->maxLength('categoria_baja', 50)
            ->allowEmptyString('categoria_baja');

        $validator
            ->integer('comprasstock_id')
            ->allowEmptyString('comprasstock_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {


        return $rules;
    }
}
