<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductosVentas Model
 *
 * @method \App\Model\Entity\ProductosVenta newEmptyEntity()
 * @method \App\Model\Entity\ProductosVenta newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProductosVenta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductosVenta get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductosVenta findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProductosVenta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductosVenta[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductosVenta|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductosVenta saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductosVenta[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductosVenta[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductosVenta[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductosVenta[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductosVentasTable extends Table
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

        $this->setTable('productos_ventas');
        $this->setDisplayField('idproductos_ventas');
        $this->setPrimaryKey('idproductos_ventas');

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
            ->integer('productos_idproductos')
            ->requirePresence('productos_idproductos', 'create')
            ->notEmptyString('productos_idproductos');

        $validator
            ->integer('ventas_idventas')
            ->requirePresence('ventas_idventas', 'create')
            ->notEmptyString('ventas_idventas');

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
            ->where(['ventas_idventas' => $options['pedidos_idpedidos']]);

        return $result;

    }

    public function findGetCantidadProductos(Query $query, $options = [])
    {

        $result = $query->select(['suma' => $query->func()->sum('cantidad')])
            ->where(['ventas_idventas' => $options['id_venta']]);;

        return $result;

    }

}
