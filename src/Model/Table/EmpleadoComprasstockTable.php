<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmpleadoComprasstock Model
 *
 * @method \App\Model\Entity\EmpleadoComprasstock newEmptyEntity()
 * @method \App\Model\Entity\EmpleadoComprasstock newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\EmpleadoComprasstock[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmpleadoComprasstock get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmpleadoComprasstock findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\EmpleadoComprasstock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmpleadoComprasstock[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmpleadoComprasstock|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmpleadoComprasstock saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmpleadoComprasstock[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmpleadoComprasstock[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmpleadoComprasstock[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmpleadoComprasstock[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmpleadoComprasstockTable extends Table
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

        $this->setTable('empleado_comprasstock');
        $this->setDisplayField('idempleado_comprastock');
        $this->setPrimaryKey('idempleado_comprastock');

        $this->addBehavior('Timestamp');
        $this->hasOne('Users', [
            'className' => 'Users',
            'foreignKey' => 'idusers',
            'bindingKey' => 'users_idusers', //actual
            'joinType' => 'INNER',
            'propertyName' => 'Users'
        ]);

        $this->hasOne('Productos', [
            'className' => 'Productos',
            'foreignKey' => 'idproductos',
            'bindingKey' => 'productos_idproductos', //actual
            'joinType' => 'INNER'
        ]);

        $this->hasOne('ComprasStock', [
            'foreignKey' => 'idcompras_stock',
            'bindingKey' => 'comprasstock_idcomprasstock', //actual
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
            ->integer('comprasstock_idcomprasstock')
            ->requirePresence('comprasstock_idcomprasstock', 'create')
            ->notEmptyString('comprasstock_idcomprasstock');

        $validator
            ->integer('productos_idproductos')
            ->requirePresence('productos_idproductos', 'create')
            ->notEmptyString('productos_idproductos');

        $validator
            ->integer('cantidad')
            ->requirePresence('cantidad', 'create')
            ->notEmptyString('cantidad');

        $validator
            ->scalar('comprobante')
            ->maxLength('comprobante', 150)
            ->allowEmptyString('comprobante');

        $validator
            ->integer('users_idusers')
            ->allowEmptyString('users_idusers');

        $validator
            ->allowEmptyString('status');

        $validator
            ->scalar('observaciones')
            ->maxLength('observaciones', 250)
            ->allowEmptyString('observaciones');

        return $validator;
    }
    public function findGetProductosUpdate(Query $query, $options = [])
    {

        $result = $query
            ->where(['comprasstock_idcomprasstock' => $options['comprasstock_idcomprasstock'], 'status' => 1]);;

        return $result;

    }
    public function findGetProductosUpdateBYCompra(Query $query, $options = [])
    {

        $result = $query
            ->where(['comprasstock_idcomprasstock' => $options['comprasstock_idcomprasstock'], 'status' => 1]);;

        return $result;

    }


}
