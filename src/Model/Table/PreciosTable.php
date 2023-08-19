<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Precios Model
 *
 * @method \App\Model\Entity\Precio newEmptyEntity()
 * @method \App\Model\Entity\Precio newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Precio[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Precio get($primaryKey, $options = [])
 * @method \App\Model\Entity\Precio findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Precio patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Precio[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Precio|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Precio saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Precio[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Precio[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Precio[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Precio[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PreciosTable extends Table
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

        $this->setTable('precios');
        $this->setDisplayField('idprecios');
        $this->setPrimaryKey('idprecios');

        $this->addBehavior('Timestamp');

        $this->hasOne('Productos', [
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
            ->numeric('precio')
            ->allowEmptyString('precio');

        $validator
            ->numeric('descuento')
            ->allowEmptyString('descuento');

        $validator
            ->notEmptyString('active');

        $validator
            ->integer('productos_idproductos')
            ->requirePresence('productos_idproductos', 'create')
            ->notEmptyString('productos_idproductos');

        return $validator;
    }


    public function findGetLastPrecioValor(Query $query, $options = [])
    {

        $id_producto = $options['idproducto'];
        $result = $query->select(['idprecios'])->where(['productos_idproductos' => $id_producto, 'active' => 1]);
        return $result;

    }


}
