<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductosComprasstock Model
 *
 * @method \App\Model\Entity\ProductosComprasstock newEmptyEntity()
 * @method \App\Model\Entity\ProductosComprasstock newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProductosComprasstock[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductosComprasstock get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductosComprasstock findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProductosComprasstock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductosComprasstock[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductosComprasstock|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductosComprasstock saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductosComprasstock[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductosComprasstock[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductosComprasstock[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProductosComprasstock[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductosComprasstockTable extends Table
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

        $this->setTable('productos_comprasstock');
        $this->setDisplayField('idproductos_comprasstock');
        $this->setPrimaryKey('idproductos_comprasstock');

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
            ->integer('comprasstock_idcomprasstock')
            ->requirePresence('comprasstock_idcomprasstock', 'create')
            ->notEmptyString('comprasstock_idcomprasstock');

        $validator
            ->integer('cantidad')
            ->allowEmptyString('cantidad');

        $validator
            ->numeric('precio_unidad')
            ->allowEmptyString('precio_unidad');

        $validator
            ->scalar('descuento_unidad')
            ->maxLength('descuento_unidad', 45)
            ->allowEmptyString('descuento_unidad');

        $validator
            ->scalar('comprobante')
            ->maxLength('comprobante', 150)
            ->allowEmptyString('comprobante');

        $validator
            ->allowEmptyString('status');

        $validator
            ->scalar('observaciones')
            ->maxLength('observaciones', 250)
            ->allowEmptyString('observaciones');

        $validator
            ->allowEmptyString('is_stock');

        $validator
            ->integer('cantidad_pedido')
            ->allowEmptyString('cantidad_pedido');

        return $validator;
    }


    public function findGetLastPrecioCompra(Query $query, $options = [])
    {
        $idproductos = $options['productos_idproductos'];

        return $query
            ->select(['precio' => 'precio_unidad'])
            ->where(['productos_idproductos' => $idproductos, 'status' => 1, 'is_stock' => 1])
            ->order(['modified DESC']);
    }

}
