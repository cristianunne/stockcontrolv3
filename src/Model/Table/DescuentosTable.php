<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Descuentos Model
 *
 * @method \App\Model\Entity\Descuento newEmptyEntity()
 * @method \App\Model\Entity\Descuento newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Descuento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Descuento get($primaryKey, $options = [])
 * @method \App\Model\Entity\Descuento findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Descuento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Descuento[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Descuento|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Descuento saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Descuento[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Descuento[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Descuento[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Descuento[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DescuentosTable extends Table
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

        $this->setTable('descuentos');
        $this->setDisplayField('iddescuentos');
        $this->setPrimaryKey('iddescuentos');

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
            ->notEmptyString('active');

        $validator
            ->integer('productos_idproductos')
            ->requirePresence('productos_idproductos', 'create')
            ->notEmptyString('productos_idproductos');

        $validator
            ->dateTime('finished')
            ->allowEmptyDateTime('finished');

        return $validator;
    }

    public function validatePrecio (Validator $validator)
    {
        $validator = $this->validationDefault($validator);

        $validator->add('precio', 'validPrecio', [
        'rule' => ['comparison', '>', 0],
        'message' => __('El valor tiene que ser mayor o igual que 0'),
        'provider' => 'table',
            ]);

        /*$validator->add('precio', 'comparison', ['rule' => ['>', 0]]);

        array(
            'precio' => array(
                'rule' => array('comparison', '>', 0),
                'message' => 'El valor tiene que ser mayor o igual que 0.'
            )
        );*/
        return $validator;
    }



    public function findGetLastDescuentoValor(Query $query, $options = [])
    {

        $idproducto = $options['idproducto'];
        $result = $query->select(['iddescuentos'])->where(['productos_idproductos' => $idproducto, 'active' => 1]);
        return $result;

    }


}
