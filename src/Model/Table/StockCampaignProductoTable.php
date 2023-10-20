<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockCampaignProducto Model
 *
 * @method \App\Model\Entity\StockCampaignProducto newEmptyEntity()
 * @method \App\Model\Entity\StockCampaignProducto newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\StockCampaignProducto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockCampaignProducto get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockCampaignProducto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\StockCampaignProducto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockCampaignProducto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockCampaignProducto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockCampaignProducto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockCampaignProducto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StockCampaignProducto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\StockCampaignProducto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StockCampaignProducto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StockCampaignProductoTable extends Table
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

        $this->setTable('stock_campaign_producto');
        $this->setDisplayField('idstock_campaign_producto');
        $this->setPrimaryKey('idstock_campaign_producto');

        $this->addBehavior('Timestamp');

        $this->hasOne('Productos', [
            'foreignKey' => 'idproductos',
            'bindingKey' => 'productos_idproductos', //actual
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
            ->integer('stock_camion_campaign_idstock_camion_campaign')
            ->requirePresence('stock_camion_campaign_idstock_camion_campaign', 'create')
            ->notEmptyString('stock_camion_campaign_idstock_camion_campaign');

        $validator
            ->integer('productos_idproductos')
            ->requirePresence('productos_idproductos', 'create')
            ->notEmptyString('productos_idproductos');

        $validator
            ->integer('cantidad')
            ->requirePresence('cantidad', 'create')
            ->notEmptyString('cantidad');

        $validator
            ->integer('cantidad_initial')
            ->requirePresence('cantidad_initial', 'create')
            ->notEmptyString('cantidad_initial');

        $validator
            ->notEmptyString('status');

        return $validator;
    }
}
