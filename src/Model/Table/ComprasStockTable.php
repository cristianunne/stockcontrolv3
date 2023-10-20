<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ComprasStock Model
 *
 * @method \App\Model\Entity\ComprasStock newEmptyEntity()
 * @method \App\Model\Entity\ComprasStock newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ComprasStock[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ComprasStock get($primaryKey, $options = [])
 * @method \App\Model\Entity\ComprasStock findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ComprasStock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ComprasStock[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ComprasStock|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ComprasStock saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ComprasStock[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ComprasStock[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ComprasStock[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ComprasStock[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ComprasStockTable extends Table
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

        $this->setTable('compras_stock');
        $this->setDisplayField('idcompras_stock');
        $this->setPrimaryKey('idcompras_stock');

        $this->addBehavior('Timestamp');

        $this->hasOne('Users', [
            'className' => 'Users',
            'foreignKey' => 'idusers',
            'bindingKey' => 'users_idusers', //actual
            'joinType' => 'INNER',
            'propertyName' => 'Users'
        ]);

        $this->hasOne('UsersComprador', [
            'className' => 'Users',
            'foreignKey' => 'idusers',
            'bindingKey' => 'users_comprador', //actual
            'propertyName' => 'UsersComprador'
        ]);

        $this->belongsToMany('Productos', [
            'foreignKey' => 'comprasstock_idcomprasstock',
            'bindingKey' => 'idcompras_stock',
            'targetForeignKey' => 'productos_idproductos', //pedidos_idpedidos
            'joinTable' => 'productos_comprasstock',
        ]);

        $this->hasMany('EmpleadoComprasstock', [
            'foreignKey' => 'comprasstock_idcomprasstock',
            'bindingKey' => 'idcompras_stock', //actual
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
            ->integer('users_comprador')
            ->allowEmptyString('users_comprador');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 500)
            ->allowEmptyString('descripcion');

        $validator
            ->notEmptyString('status');

        $validator
            ->dateTime('finished')
            ->allowEmptyDateTime('finished');

        $validator
            ->allowEmptyString('assign');

        $validator
            ->notEmptyString('is_closed');

        $validator
            ->scalar('hash_control')
            ->maxLength('hash_control', 255)
            ->allowEmptyString('hash_control');

        return $validator;
    }
}
