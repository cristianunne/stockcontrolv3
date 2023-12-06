<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pedidos Model
 *
 * @property \App\Model\Table\ProductosTable&\Cake\ORM\Association\BelongsToMany $Productos
 *
 * @method \App\Model\Entity\Pedido newEmptyEntity()
 * @method \App\Model\Entity\Pedido newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Pedido[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pedido get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pedido findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Pedido patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pedido[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pedido|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pedido saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PedidosTable_ extends Table
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

        $this->setTable('pedidos');
        $this->setDisplayField('idpedidos');
        $this->setPrimaryKey('idpedidos');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Productos', [
            'foreignKey' => 'pedidos_idpedidos',
            'bindingKey' => 'idpedidos',
            'targetForeignKey' => 'productos_idproductos', //pedidos_idpedidos
            'joinTable' => 'productos_pedidos',
        ]);

        $this->hasOne('Clientes', [
            'foreignKey' => 'idclientes',
            'bindingKey' => 'clientes_idclientes', //actual pedidos_idpedidos
            'joinType' => 'INNER'
        ]);

        $this->hasOne('Empleado', [
            'className' => 'Users',
            'foreignKey' => 'idusers',
            'bindingKey' => 'empleado_idempleado', //actual
            'propertyName' => 'Empleado'
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
            ->requirePresence('number', 'create')
            ->notEmptyString('number');

        $validator
            ->scalar('status')
            ->maxLength('status', 45)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

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
            ->scalar('observaciones')
            ->maxLength('observaciones', 500)
            ->allowEmptyString('observaciones');

        return $validator;
    }

    public function findGetMaxNumberPedidos(Query $query, $options = [])
    {

        $result = $query->select(['max' => $query->func()->max('number')]);

        return $result;

    }
}
