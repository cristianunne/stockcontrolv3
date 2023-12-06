<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductosPedidos Model
 *
 * @method \App\Model\Entity\ProductosPedido newEmptyEntity()
 * @method \App\Model\Entity\ProductosPedido newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProductosPedido[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductosPedido get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductosPedido findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProductosPedido patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductosPedido[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductosPedido|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductosPedido saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductosPedido[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductosPedido[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductosPedido[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductosPedido[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductosPedidosTable extends Table
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

        $this->setTable('productos_pedidos');
        $this->setDisplayField('idproductos_pedidos');
        $this->setPrimaryKey('idproductos_pedidos');

        $this->addBehavior('Timestamp');

        $this->hasOne('ProdPedidos', [
            'className' => 'Productos',
            'foreignKey' => 'idproductos',
            'bindingKey' => 'productos_idproductos', //actual
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
            ->integer('productos_idproductos')
            ->requirePresence('productos_idproductos', 'create')
            ->notEmptyString('productos_idproductos');

        $validator
            ->integer('pedidos_idpedidos')
            ->requirePresence('pedidos_idpedidos', 'create')
            ->notEmptyString('pedidos_idpedidos');

        $validator
            ->integer('cantidad')
            ->requirePresence('cantidad', 'create')
            ->notEmptyString('cantidad');

        $validator
            ->numeric('precio_unidad')
            ->requirePresence('precio_unidad', 'create')
            ->notEmptyString('precio_unidad');

        $validator
            ->numeric('descuento_unidad')
            ->allowEmptyString('descuento_unidad');

        return $validator;
    }

    public function findGetTotales(Query $query, $options = [])
    {

        $result = $query->select(['subtotal' => $query->func()->sum('cantidad * precio_unidad'),
            'total_descuento' => $query->func()->sum('cantidad * descuento_unidad'),
            'total' => $query->func()->sum('(cantidad * precio_unidad) - (cantidad * descuento_unidad)')])
        ->where(['pedidos_idpedidos' => $options['pedidos_idpedidos']]);

        return $result;

    }

    public function findGetCantidadProductos(Query $query, $options = [])
    {

        $result = $query->select(['suma' => $query->func()->sum('cantidad')])
            ->where(['pedidos_idpedidos' => $options['idpedidos']]);;

        return $result;

    }



}
