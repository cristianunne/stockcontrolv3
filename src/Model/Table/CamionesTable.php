<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Camiones Model
 *
 * @method \App\Model\Entity\Camione newEmptyEntity()
 * @method \App\Model\Entity\Camione newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Camione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Camione get($primaryKey, $options = [])
 * @method \App\Model\Entity\Camione findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Camione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Camione[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Camione|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Camione saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Camione[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Camione[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Camione[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Camione[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CamionesTable extends Table
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

        $this->setTable('camiones');
        $this->setDisplayField('idcamiones');
        $this->setPrimaryKey('idcamiones');
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
            ->scalar('marca')
            ->maxLength('marca', 100)
            ->allowEmptyString('marca');

        $validator
            ->scalar('matricula')
            ->maxLength('matricula', 45)
            ->allowEmptyString('matricula');

        return $validator;
    }
}
