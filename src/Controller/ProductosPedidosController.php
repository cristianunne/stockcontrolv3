<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;

/**
 * ProductosPedidos Controller
 *
 * @property \App\Model\Table\ProductosPedidosTable $ProductosPedidos
 */
class ProductosPedidosController extends AppController
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


    public function add($id_pedido = null, $id_producto = null, $precio = null, $descuento = null)
    {

        if ($id_pedido == null or $id_producto == null)
        {

            $this->Flash->error(__('Error al agregar el Producto. Intenta nuevamente'));
            $this->redirect($this->request->referer());

        } else {

            $conn = ConnectionManager::get('default');
            $conn->begin();

            $prod_ped = $this->ProductosPedidos->newEmptyEntity();

            $producto = $this->_getNameProductById($id_producto);

            if ($this->request->is('post'))
            {

                $prod_ped = $this->ProductosPedidos->patchEntity($prod_ped, $this->request->getData());

                $prod_ped->pedidos_idpedidos = $id_pedido;
                $prod_ped->productos_idproductos = $id_producto;

                if($this->ProductosPedidos->save($prod_ped)){

                    $pedidos_controller = new PedidosController();

                    if ($pedidos_controller->updatePedido($id_pedido)) {

                        $conn->commit();

                        $this->Flash->success(__('El Producto se ha editado correctamente'));
                        return $this->redirect(['controller' => 'Pedidos', 'action' => 'addProductoIndex', $id_pedido]);
                    }


                    $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
                    $conn->rollback();

                }

                $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
            }

            $this->set(compact('prod_ped'));
            $this->set(compact('id_pedido'));
            $this->set(compact('producto'));
            $this->set(compact('precio'));
            $this->set(compact('descuento'));

        }



    }


    public function edit($pedidos_idpedidos = null, $id = null, $producto_name = null)
    {

        if ($id != null){
            try {

                $saveStatus = 1;
                $conn = ConnectionManager::get('default');
                $conn->begin();

                $productos_pedidos = $this->ProductosPedidos->get($id);
                $productos_pedidos_aux = $this->ProductosPedidos->get($id);;
                if ($this->request->is(['patch', 'post', 'put'])) {

                    $productos_pedidos = $this->ProductosPedidos->patchEntity($productos_pedidos, $this->request->getData());

                    if($this->ProductosPedidos->save($productos_pedidos, ['atomic' => false])){

                        //tengo que actualizar la tabla pedidos

                        $pedidos_controller = new PedidosController();

                        if ($pedidos_controller->updatePedido($pedidos_idpedidos)) {

                            $conn->commit();

                            $this->Flash->success(__('El Producto se ha editado correctamente'));
                            return $this->redirect(['controller' => 'Pedidos', 'action' => 'view', $pedidos_idpedidos]);
                        }

                        $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
                        $conn->rollback();

                    }

                }

                $this->set(compact('productos_pedidos', 'producto_name'));


            } catch (InvalidPrimaryKeyException $e){
                $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

            } catch (RecordNotFoundException $e){
                    $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
            } catch (Exception $e){
                    $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
            }

        } else {
            return $this->redirect($this->request->referer());
        }



    }

    public function delete($pedidos_idpedidos = null, $id = null)
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);

        try{
            $conn = ConnectionManager::get('default');
            $conn->begin();

            $prod_prec =  $this->ProductosPedidos->get($id);

            if ($this->ProductosPedidos->delete($prod_prec)) {

                //llamo al controlador para actualizar
                $pedidos_controller = new PedidosController();

                if ($pedidos_controller->updatePedido($pedidos_idpedidos)){

                    $conn->commit();
                    $this->Flash->success(__('El Producto ha sido eliminado.'));
                    return $this->redirect($this->request->referer());

                } else {
                    $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
                    $conn->rollback();
                    return $this->redirect($this->request->referer());
                }


            } else {
                $this->Flash->error(__('El Registro no pudo ser eliminado. Intente nuevamente.'));
            }

        } catch (InvalidPrimaryKeyException $e){
            $this->Flash->error(__('El Registro no pudo ser eliminado. Intente nuevamente.'));

        } catch (RecordNotFoundException $e){
            $this->Flash->error(__('El Registro no pudo ser eliminado. Intente nuevamente.'));
        }
        catch (Exception $e){
            $this->Flash->error(__('El Registro no pudo ser eliminado. Intente nuevamente.'));
        }

    }

    private function _getNameProductById($id_producto = null)
    {

        try {

            $model_pedidos_productos = $this->getTableLocator()->get('Productos');

            $producto = $model_pedidos_productos->get($id_producto);

            return $producto->name . ' ' . $producto->content . ' ' . $producto->unidad . ' (' . $producto->name . ')';

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
