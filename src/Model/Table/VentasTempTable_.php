<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VentasTemp Model
 *
 * @method \App\Model\Entity\VentasTemp newEmptyEntity()
 * @method \App\Model\Entity\VentasTemp newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\VentasTemp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VentasTemp get($primaryKey, $options = [])
 * @method \App\Model\Entity\VentasTemp findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\VentasTemp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VentasTemp[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\VentasTemp|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VentasTemp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VentasTemp[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\VentasTemp[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\VentasTemp[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\VentasTemp[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VentasTempTable_ extends Table
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

        $this->setTable('ventas_temp');
        $this->setDisplayField('idventas');
        $this->setPrimaryKey('idventas');

        $this->addBehavior('Timestamp');

        $this->hasOne('Clientes', [
            'foreignKey' => 'idclientes',
            'bindingKey' => 'clientes_idclientes', //actual
        ]);

        $this->hasOne('Users', [
            'foreignKey' => 'idusers',
            'bindingKey' => 'users_idusers', //actual
        ]);

        $this->belongsToMany('Productos', [
            'foreignKey' => 'ventas_idventas_temp',
            'bindingKey' => 'idventas',
            'targetForeignKey' => 'productos_idproductos', //pedidos_idpedidos
            'joinTable' => 'ProductosVentasTemp',
        ]);


        $this->hasMany('ProductosVentasTemp', [
            'foreignKey' => 'ventas_idventas_temp',
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
            ->allowEmptyString('subtotal');

        $validator
            ->numeric('descuentos')
            ->allowEmptyString('descuentos');

        $validator
            ->numeric('total')
            ->allowEmptyString('total');

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
            ->integer('campaign_idcampaign')
            ->allowEmptyString('campaign_idcampaign');

        $validator
            ->allowEmptyString('status');

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
}
