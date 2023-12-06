<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Productos Model
 *
 * @property \App\Model\Table\PedidosTable&\Cake\ORM\Association\BelongsToMany $Pedidos
 *
 * @method \App\Model\Entity\Producto newEmptyEntity()
 * @method \App\Model\Entity\Producto newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Producto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Producto get($primaryKey, $options = [])
 * @method \App\Model\Entity\Producto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Producto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Producto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Producto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Producto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Producto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Producto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Producto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Producto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductosTable extends Table
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

        $this->setTable('productos');
        $this->setDisplayField('name');
        $this->setPrimaryKey('idproductos');

        $this->addBehavior('Timestamp');

        $this->hasOne('Subcategories', [
            'foreignKey' => 'idsubcategories',
            'bindingKey' => 'subcategories_idsubcategories', //actual
            'joinType' => 'LEFT'
        ]);

        $this->hasOne('Categories', [
            'foreignKey' => 'idcategories',
            'bindingKey' => 'categories_idcategories', //actual
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Precios', [
            'foreignKey' => 'productos_idproductos',
            'bindingKey' => 'idproductos', //actual
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Descuentos', [
            'foreignKey' => 'productos_idproductos',
            'bindingKey' => 'idproductos', //actual
            'joinType' => 'INNER'
        ]);

        $this->hasMany('CartSession', [
            'foreignKey' => 'productos_idproductos',
            'bindingKey' => 'idproductos', //actual
            'joinType' => 'INNER'
        ]);

        $this->belongsToMany('Pedidos', [
            'foreignKey' => 'productos_idproductos',
            'bindingKey' => 'idproductos',
            'targetForeignKey' => 'pedidos_idpedidos', //pedidos_idpedidos
            'joinTable' => 'productos_pedidos',
        ]);

        $this->hasOne('Proveedores', [
            'foreignKey' => 'idproveedores',
            'bindingKey' => 'proveedores_idproveedores', //actual

        ]);

        $this->hasOne('StockProductos', [
            'foreignKey' => 'productos_idproductos',
            'bindingKey' => 'idproductos', //actual
            'joinType' => 'INNER'
        ]);

        $this->hasOne('StockCampaignProducto', [
            'foreignKey' => 'productos_idproductos',
            'bindingKey' => 'idproductos', //actual
            'joinType' => 'INNER'
        ]);

        $this->hasMany('TransferenciaStock', [
            'foreignKey' => 'productos_idproductos',
            'bindingKey' => 'idproductos', //actual
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
            ->scalar('name')
            ->maxLength('name', 30)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('marca')
            ->maxLength('marca', 50)
            ->allowEmptyString('marca');

        $validator
            ->scalar('unidad')
            ->maxLength('unidad', 20)
            ->allowEmptyString('unidad');

        $validator
            ->numeric('content')
            ->requirePresence('content', 'create')
            ->notEmptyString('content');

        $validator
            ->scalar('description')
            ->maxLength('description', 150)
            ->allowEmptyString('description');

        $validator
            ->integer('subcategories_idsubcategories')
            ->allowEmptyString('subcategories_idsubcategories');

        $validator
            ->boolean('active')
            ->notEmptyString('active');

        $validator
            ->integer('categories_idcategories')
            ->allowEmptyString('categories_idcategories');

        $validator
            ->integer('proveedores_idproveedores')
            ->allowEmptyString('proveedores_idproveedores');

        $validator
            ->scalar('image')
            ->maxLength('image', 4294967295)
            ->allowEmptyFile('image');

        return $validator;
    }
}
