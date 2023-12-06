<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Devoluciones Model
 *
 * @method \App\Model\Entity\Devolucione newEmptyEntity()
 * @method \App\Model\Entity\Devolucione newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Devolucione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Devolucione get($primaryKey, $options = [])
 * @method \App\Model\Entity\Devolucione findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Devolucione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Devolucione[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Devolucione|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Devolucione saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Devolucione[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Devolucione[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Devolucione[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Devolucione[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DevolucionesTable extends Table
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

        $this->setTable('devoluciones');
        $this->setDisplayField('iddevoluciones');
        $this->setPrimaryKey('iddevoluciones');

        $this->addBehavior('Timestamp');

        $this->hasOne('Ventas', [
            'foreignKey' => 'idventas',
            'bindingKey' => 'ventas_idventas', //actual
            'joinType' => 'INNER'
        ]);

        $this->hasOne('Productos', [
            'foreignKey' => 'idproductos',
            'bindingKey' => 'productos_idproductos', //actual
            'joinType' => 'INNER'
        ]);

        $this->hasOne('Users', [
            'foreignKey' => 'idusers',
            'bindingKey' => 'users_idusers', //actual pedidos_idpedidos
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
            ->integer('ventas_idventas')
            ->requirePresence('ventas_idventas', 'create')
            ->notEmptyString('ventas_idventas');

        $validator
            ->integer('productos_idproductos')
            ->allowEmptyString('productos_idproductos');

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

        $validator
            ->integer('users_idusers')
            ->requirePresence('users_idusers', 'create')
            ->notEmptyString('users_idusers');

        $validator
            ->integer('id_productos_ventas')
            ->allowEmptyString('id_productos_ventas');

        $validator
            ->allowEmptyString('is_stock');

        return $validator;
    }
}
