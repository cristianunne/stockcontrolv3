<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductosVentasTemp Model
 *
 * @method \App\Model\Entity\ProductosVentasTemp newEmptyEntity()
 * @method \App\Model\Entity\ProductosVentasTemp newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProductosVentasTemp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductosVentasTemp get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductosVentasTemp findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProductosVentasTemp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductosVentasTemp[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductosVentasTemp|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductosVentasTemp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductosVentasTemp[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductosVentasTemp[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductosVentasTemp[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductosVentasTemp[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductosVentasTempTable extends Table
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

        $this->setTable('productos_ventas_temp');
        $this->setDisplayField('idproductos_ventas_temp');
        $this->setPrimaryKey('idproductos_ventas_temp');

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
            ->integer('ventas_idventas_temp')
            ->requirePresence('ventas_idventas_temp', 'create')
            ->notEmptyString('ventas_idventas_temp');

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

    public function findGetCantidadProductos(Query $query, $options = [])
    {

        $result = $query->select(['suma' => $query->func()->sum('cantidad')])
            ->where(['ventas_idventas_temp' => $options['idventatemp']]);;

        return $result;

    }
}
