<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;
use Cake\ORM\Query;

/**
 * Precios Controller
 *
 * @property \App\Model\Table\PreciosTable $Precios
 */
class PreciosController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event); // TODO: Change the autogenerated stub


        $user = $this->Authentication->getIdentity();
        if(isset($user) and $user->role === 'user')
        {
            if (!in_array($this->request->getParam('action'), ['index', 'edit'])) {
                //$this->redirect($this->request->referer());
                $this->Flash->error('Usted no esta autorizado para acceder al Sitio Solicitado');
                $this->redirect(['controller' => 'Index', 'action' => 'index']);
            }

        }
        $this->loadCartProduct();
    }


    public function index()
    {
        $id_users = $this->Authentication->getIdentity()->idusers;

        $productos_model = $this->getTableLocator()->get('Productos');

        $productos = $productos_model->find('all', [
            'contain' => ['Categories', 'Subcategories', 'Proveedores','Precios' => function(Query $q){

                return $q->where(['active' => 1]);
            }, 'Descuentos' => function(Query $q){

                return $q->where(['active' => 1]);
            }]
        ])->order(['idproductos' => 'ASC']);

        /*$productos = $this->Productos->find('all', [
            'contain' => ['Categories', 'Subcategories', 'Proveedores','Precios' => function(Query $q){

                return $q->where(['active' => 1]);
            }, 'Descuentos' => function(Query $q){

                return $q->where(['active' => 1]);
            }]
        ])->order(['idproductos' => 'ASC']);*/


        //debug($productos->toArray());
        //debug($this->cart_product);

        $this->set(compact('productos'));

    }


    public function add($id_productos = null)
    {

        if ($id_productos == null)
        {
            $this->Flash->error('Tenemos inconvenientes para actualizar el Precio. Intente nuevamente.');
            return $this->redirect($this->request->referer());
        }
        $precio = $this->Precios->newEmptyEntity();

        //debug($id_productos);

        //la compra tuvo que haber sido aprobada y estockeada
        $productos_compras_model = $this->getTableLocator()->get('ProductosComprasstock');

        $last_price = $productos_compras_model->find('GetLastPrecioCompra', ['productos_idproductos' => $id_productos])->first();

        //debug($last_price);

        $last_price = isset($last_price->precio) ? $last_price->precio : 0;

        $last_price = $last_price == null ? 0 : $last_price;

        $this->set(compact('last_price'));
        //debug($last_price->toArray());


        if ($this->request->is('post')) {

            $options['idproducto'] = $id_productos;
            //traigo el ultimo precio con valor



            //$id_precio_valor = $this->Precios->find('GetLastPrecioValor', $options)->toArray()[0]->idprecios;

            $id_precio_valor = !isset($this->Precios->find('GetLastPrecioValor', $options)->toArray()[0]->idprecios) ?
                false : $this->Precios->find('GetLastPrecioValor', $options)->toArray()[0]->idprecios;

            if ($id_precio_valor) {
                if($this->_setPriceToFalse($id_precio_valor))
                {
                    $precio = $this->Precios->patchEntity($precio, $this->request->getData());

                    $precio->productos_idproductos = $id_productos;

                    if ($this->Precios->save($precio)) {
                        $this->Flash->success(__('El Precio se almaceno correctamente.'));


                        return $this->redirect(['controller' => 'Productos', 'action' => 'viewConfig', $id_productos]);
                    }
                    $this->Flash->error(__('El Precio no se pudo guardar. Intente nuevamente.'));
                } else {
                    $this->Flash->error(__('El Precio no se pudo guardar. Intente nuevamente.'));
                }
            } else {
                $precio = $this->Precios->patchEntity($precio, $this->request->getData());

                $precio->productos_idproductos = $id_productos;

                if ($this->Precios->save($precio)) {
                    $this->Flash->success(__('El Precio se almaceno correctamente.'));


                    return $this->redirect(['controller' => 'Productos', 'action' => 'viewConfig', $id_productos]);
                }
                $this->Flash->error(__('El Precio no se pudo guardar. Intente nuevamente.'));
            }


        }
        $this->set(compact('id_productos'));
        $this->set(compact('precio'));

    }


    public function addAllProductos()
    {


        if($this->request->is('post')){

            $precio_input = $this->request->getData('precio');

            //traigo los productos con precios cargados
            $productos_model = $this->getTableLocator()->get('Productos');

            $productos = $productos_model->find('all', [
                'contain' => ['Precios' => function ($q){

                    return $q->where(['active' => 1]);
                }]
            ]);

            $productos_with_precios = $this->_getProductosWithPrecios($productos);

            $precios_viejos = [];


            foreach ($productos_with_precios as $prod)
            {
                $precio = $prod->precios[0];
                $precio->active = 0;
                $precios_viejos[] = $precio;

                //actualizo el precio
                $precio_entity = $this->Precios->newEmptyEntity();
                $precio_entity->precio = $precio->precio + ($precio->precio / 100 * $precio_input);
                $precio_entity->active = 1;
                $precio_entity->productos_idproductos = $precio->productos_idproductos;
                $precios_viejos[] = $precio_entity;

            }

            if($this->Precios->saveMany($precios_viejos))
            {
                $this->Flash->success(__('Los Precios se actualizaron correctamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El Precio no se pudo guardar. Intente nuevamente.'));


        }
    }

    private function _getProductosWithPrecios($productos)
    {
        $productos_w_precios = null;

        foreach ($productos as $prod) {

            if ($prod->precios != null){
                $productos_w_precios[] = $prod;
            }

        }
        return $productos_w_precios;
    }


    public function edit($id_precio = null, $id_producto = null)
    {
        if ($id_producto == null)
        {
            $this->Flash->error('Tenemos inconvenientes para actualizar el Precio. Intente nuevamente.');
            return $this->redirect($this->request->referer());
        }
        $precio = $this->Precios->get($id_precio);


        if ($this->request->is(['patch', 'post', 'put'])) {

            $precio = $this->Precios->patchEntity($precio, $this->request->getData());


            if ($this->Precios->save($precio)) {
                $this->Flash->success(__('El Precio se almaceno correctamente.'));


                return $this->redirect(['controller' => 'Productos', 'action' => 'viewConfig', $id_producto]);
            }
            $this->Flash->error(__('El Precio no se pudo guardar. Intente nuevamente.'));


        }
        $this->set(compact('precio'));

    }



    private function _setPriceToFalse($id_product)
    {
        try{

            $precio =  $this->Precios->get($id_product);
            $precio->active = 0;

            if ($this->Precios->save($precio)) {

                return true;
            }

        } catch (InvalidPrimaryKeyException $e){
            return false;
        } catch (RecordNotFoundException $e){
           return false;
        }
        catch (Exception $e){
            return false;

        }
    }


    public function getPriceByProducto($id_producto = null)
    {

        $this->autoRender = false;

        if ($id_producto == null) {
            return false;
        } else {

            try {

                $conditions = ['active' => 1, 'productos_idproductos' => $id_producto];

                $precios = $this->Precios->find('all', [

                ])->where($conditions)
                    ->first();



                return $precios == null ? 0 : $precios->precio;


            } catch (InvalidPrimaryKeyException $e) {
                //$this->redirect($this->request->referer());
                $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

            } catch (RecordNotFoundException $e) {
                //$this->redirect($this->request->referer());
                $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
            } catch (Exception $e) {
                //debug($e);
                //$this->redirect($this->request->referer());
                $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
            }

            return false;

        }
    }

}
