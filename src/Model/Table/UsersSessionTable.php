<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersSession Model
 *
 * @method \App\Model\Entity\UsersSession newEmptyEntity()
 * @method \App\Model\Entity\UsersSession newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\UsersSession[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersSession get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersSession findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\UsersSession patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersSession[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersSession|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersSession saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersSession[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UsersSession[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\UsersSession[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UsersSession[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersSessionTable extends Table
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

        $this->setTable('users_session');
        $this->setDisplayField('idusers_session');
        $this->setPrimaryKey('idusers_session');

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
            ->nonNegativeInteger('users_idusers')
            ->requirePresence('users_idusers', 'create')
            ->notEmptyString('users_idusers');

        $validator
            ->scalar('api_key')
            ->maxLength('api_key', 255)
            ->requirePresence('api_key', 'create')
            ->notEmptyString('api_key');

        return $validator;
    }
}
