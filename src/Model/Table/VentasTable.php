<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ventas Model
 *
 * @property \App\Model\Table\ProductosTable&\Cake\ORM\Association\BelongsToMany $Productos
 *
 * @method \App\Model\Entity\Venta newEmptyEntity()
 * @method \App\Model\Entity\Venta newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Venta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Venta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Venta findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Venta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Venta[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Venta|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Venta saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Venta[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Venta[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Venta[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Venta[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VentasTable extends Table
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

        $this->setTable('ventas');
        $this->setDisplayField('idventas');
        $this->setPrimaryKey('idventas');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Productos', [
            'foreignKey' => 'ventas_idventas',
            'bindingKey' => 'idventas',
            'targetForeignKey' => 'productos_idproductos', //pedidos_idpedidos
            'joinTable' => 'productos_ventas',
        ]);

        $this->hasOne('Clientes', [
            'foreignKey' => 'idclientes',
            'bindingKey' => 'clientes_idclientes', //actual pedidos_idpedidos
            'joinType' => 'INNER'
        ]);

        $this->hasOne('Users', [
            'foreignKey' => 'idusers',
            'bindingKey' => 'users_idusers', //actual pedidos_idpedidos
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ProductosVentas', [
            'foreignKey' => 'ventas_idventas',
            'bindingKey' => 'idventas', //actual
        ]);

        $this->hasMany('Devoluciones', [
            'foreignKey' => 'ventas_idventas',
            'bindingKey' => 'idventas', //actual
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
            ->integer('users_idusers')
            ->requirePresence('users_idusers', 'create')
            ->notEmptyString('users_idusers');

        $validator
            ->integer('clientes_idclientes')
            ->requirePresence('clientes_idclientes', 'create')
            ->notEmptyString('clientes_idclientes');

        $validator
            ->numeric('subtotal')
            ->requirePresence('subtotal', 'create')
            ->notEmptyString('subtotal');

        $validator
            ->numeric('descuentos')
            ->requirePresence('descuentos', 'create')
            ->notEmptyString('descuentos');

        $validator
            ->numeric('total')
            ->requirePresence('total', 'create')
            ->notEmptyString('total');

        $validator
            ->numeric('descuento_general')
            ->allowEmptyString('descuento_general');

        $validator
            ->scalar('hash')
            ->maxLength('hash', 255)
            ->requirePresence('hash', 'create')
            ->notEmptyString('hash');

        $validator
            ->integer('pedidos_idpedidos')
            ->allowEmptyString('pedidos_idpedidos')
            ->add('pedidos_idpedidos', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('coordenadas')
            ->maxLength('coordenadas', 255)
            ->allowEmptyString('coordenadas');

        $validator
            ->requirePresence('number', 'create')
            ->notEmptyString('number');

        $validator
            ->integer('campaign_idcampaign')
            ->allowEmptyString('campaign_idcampaign');

        $validator
            ->notEmptyString('cuenta_corriente');

        $validator
            ->notEmptyString('is_pay');

        $validator
            ->integer('camion_idcamion')
            ->allowEmptyString('camion_idcamion');

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
        $rules->add($rules->isUnique(['pedidos_idpedidos'], ['allowMultipleNulls' => true]), ['errorField' => 'pedidos_idpedidos']);

        return $rules;
    }

    public function findGetMaxNumberPedidos(Query $query, $options = [])
    {

        $result = $query->select(['max' => $query->func()->max('number')]);

        return $result;

    }

    public function findGetSubTotal(Query $query, $options = [])
    {
        $conditions = [];

        if(isset($options['camion_idcamion'])){
            if($options['camion_idcamion'] != 0 && $options['camion_idcamion'] != null) {
                $conditions['camion_idcamion'] = $options['camion_idcamion'];
            }
        }

        $conditions['campaign_idcampaign'] = $options['idcampaign'];
        $conditions['cuenta_corriente'] = 0;

        $idcampaign = $options['idcampaign'];
        $result = $query->select(['subtotal' => $query->func()->sum('subtotal')])
        ->where($conditions);

        return $result;

    }

    public function findGetCuentaCorriente(Query $query, $options = [])
    {

        $conditions = [];

        if(isset($options['camion_idcamion'])){
            if($options['camion_idcamion'] != 0 && $options['camion_idcamion'] != null) {
                $conditions['camion_idcamion'] = $options['camion_idcamion'];
            }
        }

        $conditions['campaign_idcampaign'] = $options['idcampaign'];
        $conditions['cuenta_corriente'] = 1;


        $result = $query->select(['subtotal' => $query->func()->sum('subtotal')])
            ->where($conditions);

        return $result;

    }

    public function findGetDescuentos(Query $query, $options = [])
    {

        $conditions = [];

        if(isset($options['camion_idcamion'])){
            if($options['camion_idcamion'] != 0 && $options['camion_idcamion'] != null) {
                $conditions['camion_idcamion'] = $options['camion_idcamion'];
            }
        }

        $conditions['campaign_idcampaign'] = $options['idcampaign'];
        $conditions['cuenta_corriente'] = 0;

        $result = $query->select(['descuentos' => $query->func()->sum('descuentos')])
            ->where($conditions);

        return $result;

    }

    public function findGetDescuentosGeneral(Query $query, $options = [])
    {

        $conditions = [];

        if(isset($options['camion_idcamion'])){
            if($options['camion_idcamion'] != 0 && $options['camion_idcamion'] != null) {
                $conditions['camion_idcamion'] = $options['camion_idcamion'];
            }
        }

        $conditions['campaign_idcampaign'] = $options['idcampaign'];
        $conditions['cuenta_corriente'] = 0;

        $result = $query->select(['descuento_general' => $query->func()->sum('descuento_general')])
            ->where($conditions);

        return $result;

    }

    public function findGetDescuentosCuentaCorriente($query, $options = [])
    {

        $conditions = [];

        if(isset($options['camion_idcamion'])){
            if($options['camion_idcamion'] != 0 && $options['camion_idcamion'] != null) {
                $conditions['camion_idcamion'] = $options['camion_idcamion'];
            }
        }

        $conditions['campaign_idcampaign'] = $options['idcampaign'];
        $conditions['cuenta_corriente'] = 1;


        $result = $query->select(['descuentos' => $query->func()->sum('descuentos')])
            ->where($conditions);

        return $result;

    }


    public function findGetDescuentosGeneralCuentaCorriente(Query $query, $options = [])
    {

        $conditions = [];

        if(isset($options['camion_idcamion'])){
            if($options['camion_idcamion'] != 0 && $options['camion_idcamion'] != null) {
                $conditions['camion_idcamion'] = $options['camion_idcamion'];
            }
        }

        $conditions['campaign_idcampaign'] = $options['idcampaign'];
        $conditions['cuenta_corriente'] = 1;

        $result = $query->select(['descuento_general' => $query->func()->sum('descuento_general')])
            ->where($conditions);

        return $result;

    }




}
