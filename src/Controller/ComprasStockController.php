<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Exception;

/**
 * ComprasStock Controller
 *
 * @property \App\Model\Table\ComprasStockTable $ComprasStock
 */
class ComprasStockController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event); // TODO: Change the autogenerated stub

        $this->Authentication->addUnauthenticatedActions(['login']);

        $user = $this->Authentication->getIdentity();
        if (isset($user) and $user->role === 'user') {
            if (!in_array($this->request->getParam('action'), ['index', 'edit', 'view'])) {
                //$this->redirect($this->request->referer());
                $this->Flash->error('Usted no esta autorizado para acceder al Sitio Solicitado');
                $this->redirect(['controller' => 'Index', 'action' => 'index']);
            }

        }
        $this->loadCartProduct();

    }


    public function index()
    {

        $compras_stock = $this->ComprasStock->find('all', [
            'contain' => ['Users', 'UsersComprador']
        ]);

        //debug($compras_stock->toArray());

        $this->set(compact('compras_stock'));
    }


    public function add()
    {

        $compras_stock = $this->ComprasStock->newEmptyEntity();

        $users_model = $this->getTableLocator()->get('Users');
        $empleados = $users_model->find('list', [
            'keyField' => 'idusers',
            'valueField' => function($q){
                return $q['firstname'] . ' ' . $q['lastname'];
            },
            'order' => ['firstname' => 'ASC'],
        ])->toArray();

        $this->set(compact('empleados'));

        if ($this->request->is('post')) {

            $compras_stock = $this->ComprasStock->patchEntity($compras_stock, $this->request->getData());

            $user = $this->Authentication->getIdentity();

            $compras_stock->users_idusers = $user->idusers;

            $compras_stock->hash_control = hash('sha256' , (rand(1, 100000) . date("Y-m-d")));

            //debug($compras_stock);

            if ($this->ComprasStock->save($compras_stock)) {
                $this->Flash->success(__('La Compra se almaceno correctamente.'));

                //tiene que redireccionar al view del pedido.0.


                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La Compra no se pudo guardar. Intente nuevamente.'));


        }

        $this->set(compact('compras_stock'));

    }

    public function view($id = null)
    {
        try {

            $compras_stock = $this->ComprasStock->get($id, [
                'contain' => ['Users', 'UsersComprador', 'Productos' => ['Categories', 'Subcategories']]
            ]);


            //puedo consultar la tabla del empleado y ver si hizo envios, si los hizo pongo un cartel de advertencia

            $model_empleado_comprasstock = $this->getTableLocator()->get('EmpleadoComprasstock');

            $empl_compras = $model_empleado_comprasstock->find('GetProductosUpdate', ['comprasstock_idcomprasstock' =>$id]);

            $number_compras_update = count($empl_compras->toArray());

           // debug($compras_stock->toArray());


            //traigo el numero de compras aceptados
            $has_compras_update = false;

            if ($number_compras_update > $this->countNumberAprobado($compras_stock->productos))
            {
                $has_compras_update = true;
            }

            //debug($this->countNumberAprobado($compras_stock->productos));

            //debug($number_compras_update);



            //debug($compras_stock->toArray());

            $this->set(compact('has_compras_update'));
            $this->set(compact('number_compras_update'));
            $this->set(compact('compras_stock'));
        } catch (InvalidPrimaryKeyException $e) {
            //$this->redirect($this->request->referer());
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

        } catch (RecordNotFoundException $e) {
            //$this->redirect($this->request->referer());
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
        } catch (Exception $e) {
            debug($e);
            //$this->redirect($this->request->referer());
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
        }
    }

    private function countNumberAprobado($productos)
    {
        $number = 0;

        foreach ($productos as $pro){



            if($pro->_joinData->status == 1){
                $number++;
            }

        }

        return $number;

    }

    public function addProductoIndex($id_compras_stock = null)
    {
        //AGrego los productos al pedido
        //Traigo los productos que no estan en el pedido

        $model_productos_pedidos = $this->getTableLocator()->get('ProductosComprasstock');

        $prod_ped = $model_productos_pedidos->find()
            ->select(['idproductos' => 'productos_idproductos'])
            ->where(['comprasstock_idcomprasstock' => $id_compras_stock]);

        //debug($prod_ped->toArray());

        $productos_model = $this->getTableLocator()->get('Productos');

        $productos = $productos_model->find('all', [
            'contain' => ['Categories', 'Subcategories']])
            ->where(['idproductos NOT IN' => $prod_ped]);;



        //debug($productos->toArray());
        $this->set(compact('productos'));
        $this->set(compact('id_compras_stock'));
    }


    public function aprobarCompras($id_compra_stock = null)
    {

        try {
            $compras_stock = $this->ComprasStock->get($id_compra_stock, [
                'contain' => ['Productos']
            ]);

            //debug($compras_stock);

            //traigo las compras cargadas del empleado donde el status sea 1

            $model_emple_compra_stock = $this->getTableLocator()->get('EmpleadoComprasstock');
            $empl_compras = $model_emple_compra_stock->find('GetProductosUpdateBYCompra', ['comprasstock_idcomprasstock' => $id_compra_stock]);



            $this->set(compact('compras_stock'));
            $this->set(compact('empl_compras'));
            $this->set(compact('id_compra_stock'));
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


    }

    public function aprobarProductosCompras($idcompras_stock = null, $idproductos_comprasstock = null, $id_empleado_compra = null)
    {
        $this->autoRender = false;

        if($this->request->is('post')){


            $productos_compras_stock = new ProductosComprasstockController();

            if($productos_compras_stock->updateCompraToOk($idproductos_comprasstock, $id_empleado_compra)){

                //llamo al stockProductos


                $this->Flash->success(__('La compra ha sido aprobada.'));
                return $this->redirect(['action' => 'aprobarCompras', $idcompras_stock]);

            }


            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));


        }

    }


    public function aprobarCompraNew()
    {
        if ($this->request->is('POST')) {


            $array_data = $this->request->getData('array_data');
            //debug($array_data);

            $idempleado_comprastock = $array_data['idempleado_comprastock'];
            $idcomprastock = $array_data['idcomprastock'];
            $idproducto = $array_data['idproducto'];
            $idproductos_comprasstock = $array_data['idproductos_comprasstock'];
            $cantidad = $array_data['cantidad'];
            $precio = $array_data['precio'];
            $descuento = $array_data['descuento'];

            $productos_compras_stock = new ProductosComprasstockController();

            if ($productos_compras_stock->updateCompraToOk($idproductos_comprasstock, $idempleado_comprastock, $cantidad, $precio, $descuento, true)) {
                return $this->json(['result' => true]);
            }

            return $this->json(['result' => false]);
        }

    }


    public function setEmpleadoComprador($id_compras_stock = null)
    {

        if($id_compras_stock != null) {

            $users_model = $this->getTableLocator()->get('Users');
            $empleados = $users_model->find('list', [
                'keyField' => 'idusers',
                'valueField' => function($q){
                    return $q['firstname'] . ' ' . $q['lastname'];
                },
                'order' => ['firstname' => 'ASC'],
            ])->toArray();

            $this->set(compact('empleados'));

            try {


                $compras_stock = $this->ComprasStock->get($id_compras_stock);

                if ($this->request->is(['patch', 'post', 'put'])) {


                    $compras_stock = $this->ComprasStock->patchEntity($compras_stock, $this->request->getData());

                    $conn = ConnectionManager::get('default');
                    $conn->begin();

                    if($this->ComprasStock->save($compras_stock)){
                        if($this->_updateHashControl($id_compras_stock))
                        {
                            $conn->commit();
                            $this->Flash->success(__('El Empleado se ha asignado correctamente'));
                            return $this->redirect(['controller' => 'ComprasStock', 'action' => 'view', $id_compras_stock]);

                        }

                    }
                    $conn->rollback();
                    $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

                }


                $this->set(compact('id_compras_stock'));
                $this->set(compact('compras_stock'));


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



        }

    }


    public function desaprobarCompra($idcompras_stock = null, $idproductos_comprasstock = null, $productos_idproductos = null)
    {

        //al desaprobar tengo que limpiar siempre y cuando no se haya stockeado
        $this->autoRender = false;

        try {
            if ($this->request->is(['patch', 'post', 'put'])) {
                //debug($idproductos_comprasstock);

                $conn = ConnectionManager::get('default');
                $conn->begin();

                $productos_compras_stock = new ProductosComprasstockController();


                if ($productos_compras_stock->updateCompraToOk($idproductos_comprasstock, null, null, null, null, false)) {

                    $empleado_compra_controller = new EmpleadoComprasstockController();
                    if ($empleado_compra_controller->desaprobarCompraProducto($idcompras_stock, $productos_idproductos))
                    {
                        $conn->commit();
                        //desapruebo tmb la del empleadocomprastoc
                        $this->Flash->success(__('Compra Desaprobada!'));
                        return $this->redirect(['action' => 'view', $idcompras_stock]);
                    }

                }
                $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
                $conn->rollback();
            }

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



    }


    public function setAssign($id_compras_stock = null, $assign = null)
    {
        //$this->autoRender = false;
        //$this->layout = false;
        if($id_compras_stock != null and $assign != null) {
            try {
                //si asing en 0 asigno, si es 1 elimino

                if ($this->request->is(['patch', 'post', 'put'])) {

                    if($assign == 1 or $assign == '1')
                    {
                        //debug($id_compras_stock);
                        //debug($assign);

                        $conn = ConnectionManager::get('default');
                        $conn->begin();
                        $compras_stock = $this->ComprasStock->get($id_compras_stock);

                        $compras_stock->assign = $assign;
                        $compras_stock->status = 1;


                        //debug($compras_stock);

                        if($this->ComprasStock->save($compras_stock)){

                            //aca llamo a asignar

                            $empleado_compras_controller = new EmpleadoComprasstockController();
                            if ($empleado_compras_controller->add($id_compras_stock,  $compras_stock->users_comprador))
                            {

                                $conn->commit();

                                $this->Flash->success(__('La Compra se ha asignado correctamente'));
                                return $this->redirect(['controller' => 'ComprasStock', 'action' => 'view', $id_compras_stock]);

                            }

                            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
                            $conn->rollback();

                            return $this->redirect(['controller' => 'ComprasStock', 'action' => 'view', $id_compras_stock]);


                        }
                    } else if ($assign == 0 or $assign == '0')
                    {
                        $conn = ConnectionManager::get('default');
                        $conn->begin();
                        $compras_stock = $this->ComprasStock->get($id_compras_stock);

                        $compras_stock->assign = $assign;
                        $compras_stock->status = 0;


                        if($this->ComprasStock->save($compras_stock)){

                            //debug($compras_stock);
                            //aca llamo a asignar

                            $empleado_compras_controller = new EmpleadoComprasstockController();
                            if ($empleado_compras_controller->deleteById($id_compras_stock))
                            {
                                //debug($compras_stock);

                                $conn->commit();

                                $this->Flash->success(__('Se ha quitado la asignacion correctamente'));
                                return $this->redirect(['controller' => 'ComprasStock', 'action' => 'view', $id_compras_stock]);

                            }

                            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
                            $conn->rollback();

                            return $this->redirect(['controller' => 'ComprasStock', 'action' => 'view', $id_compras_stock]);


                        }

                    }

                }

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



        } else {
            return $this->redirect($this->request->referer());
        }

    }


    public function setIsStock($idproductos_comprasstock = null, $idcompras_stock = null)
    {

        $this->autoRender = false;
        $conn = ConnectionManager::get('default');
        $conn->begin();


        try{


            $productos_compras_controller = new ProductosComprasstockController();
            if ($productos_compras_controller->setStockState($idproductos_comprasstock))
            {

                $conn->commit();
                $this->Flash->success(__('El Producto ha sido asignado a Stock.'));
                return $this->redirect(['action' => 'view', $idcompras_stock]);
            }
            $conn->rollback();
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
            return $this->redirect(['action' => 'view', $idcompras_stock]);


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

    }

    public function unSetStock($idproductos_comprasstock = null, $idcompras_stock = null)
    {
        $this->autoRender = false;
        $productos_compras_controller = new ProductosComprasstockController();

        if($productos_compras_controller->unsetStockState($idproductos_comprasstock)){


            $this->Flash->success(__('El Producto ha sido elimidado a Stock.'));
            return $this->redirect(['action' => 'view', $idcompras_stock]);

        }

    }

    public function cerrarCompra($idcompra = null)
    {
        try{

            $compra = $this->ComprasStock->get($idcompra);

            $compra->is_closed = 1;
            $compra->status = 0;

            if($this->ComprasStock->save($compra)){
                $this->Flash->success(__('La compra se ha cerrado correctamente!.'));
                return $this->redirect(['action' => 'view', $idcompra]);
            }


        } catch (InvalidPrimaryKeyException $e) {

            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

        } catch (RecordNotFoundException $e) {

            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
        } catch (Exception $e) {
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
        }
    }


    private function _updateHashControl($idcompra_stock = null)
    {

        try {

            $compras_stock = $this->ComprasStock->get($idcompra_stock);
            $compras_stock->hash_control = hash('sha256' , (rand(1, 100000) . date("Y-m-d")));


            if($this->ComprasStock->save($compras_stock)){
                return true;
            }

            return false;


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

    }

}
