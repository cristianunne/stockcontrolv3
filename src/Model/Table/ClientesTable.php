<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientes Model
 *
 * @method \App\Model\Entity\Cliente newEmptyEntity()
 * @method \App\Model\Entity\Cliente newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Cliente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cliente get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cliente findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Cliente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cliente[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cliente|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cliente saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientesTable extends Table
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

        $this->setTable('clientes');
        $this->setDisplayField('idclientes');
        $this->setPrimaryKey('idclientes');

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
            ->scalar('nombre')
            ->maxLength('nombre', 100)
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre');

        $validator
            ->scalar('apellido')
            ->maxLength('apellido', 100)
            ->requirePresence('apellido', 'create')
            ->notEmptyString('apellido');

        $validator
            ->scalar('dni')
            ->maxLength('dni', 50)
            ->requirePresence('dni', 'create')
            ->notEmptyString('dni');

        $validator
            ->scalar('pais')
            ->maxLength('pais', 50)
            ->requirePresence('pais', 'create')
            ->notEmptyString('pais');

        $validator
            ->scalar('provincia')
            ->maxLength('provincia', 50)
            ->requirePresence('provincia', 'create')
            ->notEmptyString('provincia');

        $validator
            ->scalar('departamento')
            ->maxLength('departamento', 50)
            ->allowEmptyString('departamento');

        $validator
            ->scalar('localidad')
            ->maxLength('localidad', 100)
            ->requirePresence('localidad', 'create')
            ->notEmptyString('localidad');

        $validator
            ->scalar('direccion')
            ->maxLength('direccion', 100)
            ->allowEmptyString('direccion');

        $validator
            ->scalar('altura')
            ->maxLength('altura', 45)
            ->allowEmptyString('altura');

        $validator
            ->scalar('shop_name')
            ->maxLength('shop_name', 100)
            ->requirePresence('shop_name', 'create')
            ->notEmptyString('shop_name');

        $validator
            ->scalar('observaciones')
            ->maxLength('observaciones', 500)
            ->allowEmptyString('observaciones');

        $validator
            ->scalar('telefono')
            ->maxLength('telefono', 45)
            ->allowEmptyString('telefono');

        return $validator;
    }
}
