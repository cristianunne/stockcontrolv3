<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;
use Exception;

/**
 * VentasTemp Controller
 *
 * @property \App\Model\Table\VentasTempTable $VentasTemp
 */
class VentasTempController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event); // TODO: Change the autogenerated stub


        $user = $this->Authentication->getIdentity();
        if(isset($user) and $user->role === 'user')
        {
            if (!in_array($this->request->getParam('action'), [])) {
                //$this->redirect($this->request->referer());
                $this->Flash->error('Usted no esta autorizado para acceder al Sitio Solicitado');
                $this->redirect(['controller' => 'Index', 'action' => 'index']);
            }

        }
        $this->loadCartProduct();
    }

    public function selectCliente($id_campaign = null)
    {
        $user = $this->Authentication->getIdentity()->idusers;
        $ventas_temp = $this->VentasTemp->newEmptyEntity();

        //traigo los clientes almacenados
        $clientes = $this->_getClientes();

        //debug($this->_getStockCamionCampaign($id_campaign,$user)->toArray());


        if($this->request->is('post'))
        {
            $ventas_temp = $this->VentasTemp->patchEntity($ventas_temp, $this->request->getData());
            $ventas_temp->hash = hash('sha256' , (rand( 0, 1000) . date("Y-m-d")));
            $ventas_temp->users_idusers = $user;
            $ventas_temp->campaign_idcampaign = $id_campaign;

            $ventas_temp->camion_idcamion = $this->_getCamionFromCampaignByUser($user, $id_campaign)->camion_idcamion;


            if($this->VentasTemp->save($ventas_temp))
            {
                //voy a la seleccion de productos
                //debug($ventas_temp);
               // return $this->redirect(['controller' => 'productos' ,'action' => 'viewConfig', $id_producto]);
                return $this->redirect(['controller' => 'VentasTemp', 'action' => 'selectProductos', $ventas_temp->idventas]);

            } else {
                debug($ventas_temp->getErrors());
            }



        }

        $this->set(compact('id_campaign'));
        $this->set(compact('clientes'));
        $this->set(compact('ventas_temp'));

    }

    private function _getCamionFromCampaignByUser($id_user = null, $idcampaign = null)
    {
        $model_camion_campaign = $this->getTableLocator()->get('StockCamionCampaign');

        $camion = $model_camion_campaign->find('all', [
            'fields' => ['camion_idcamion']
        ])->where(['users_idusers' => $id_user, 'campaign_idcampaign' => $idcampaign])->first();

        return $camion;
    }


    public function selectProductos($id_ventas_temp = null)
    {

        //tendria que traer los productos asignados al camion
        //tengo la campaign como para filtrar y el user

        try{

            //tengo que traer el total vendido por productos


            $ventas_temp = $this->VentasTemp->get($id_ventas_temp);

            $productos =  $this->_getStockCamionCampaign($ventas_temp->campaign_idcampaign, $ventas_temp->users_idusers)->first();

            //debug($productos->toArray());
            $id_campaign = $ventas_temp->campaign_idcampaign;

            $this->set(compact('id_campaign'));
            $this->set(compact('productos'));
            $this->set(compact('ventas_temp'));
            $this->set(compact('id_ventas_temp'));

        } catch (InvalidPrimaryKeyException $e){

            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

        } catch (RecordNotFoundException $e){
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
        }
        catch (Exception $e){

            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
        }




    }


    public function view($id_venta_temp = null)
    {
        try{

            $ventas_temp = $this->VentasTemp->get($id_venta_temp,
            ['contain' => ['Users', 'Productos' => ['Categories'], 'Clientes']]);

            $cant_productos = $this->getTotalesProductos($id_venta_temp)->suma;


            //debug($ventas_temp->toArray());
            $id_campaign = $ventas_temp->campaign_idcampaign;

            $this->set(compact('id_campaign'));
            $this->set(compact('ventas_temp'));
            $this->set(compact('cant_productos'));
            $this->set(compact('id_venta_temp'));


        } catch (InvalidPrimaryKeyException $e){

            debug($e->getMessage());
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

        } catch (RecordNotFoundException $e){
            debug($e->getMessage());
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
        }
        catch (Exception $e){
            debug($e->getMessage());
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
        }

    }



    public function updateVentasTemp($id_ventas_temp = null, $data = null, $operation = null)
    {

        try{
           // debug($data);

            $ventas_temp = $this->VentasTemp->get($id_ventas_temp);

            $subtotal = ($data['cantidad'] * $data['precio']);
            $descuentos = ($data['cantidad'] * $data['descuento']);
            //debug($subtotal);
            //debug($descuentos);

            if ($operation == true) {
                $ventas_temp->subtotal = $ventas_temp->subtotal + $subtotal;
                $ventas_temp->descuentos = $ventas_temp->descuentos + $descuentos;
                $ventas_temp->total =  $ventas_temp->subtotal - $ventas_temp->descuentos;
            }

            if ($operation == false) {
                $ventas_temp->subtotal = $ventas_temp->subtotal - $subtotal;
                $ventas_temp->descuentos = $ventas_temp->descuentos - $descuentos;
                $ventas_temp->total =  $ventas_temp->subtotal - $ventas_temp->descuentos;
            }

            //debug($ventas_temp);


            if($this->VentasTemp->save($ventas_temp)) {
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
        return false;
    }


    public function updateEditVentasTemp($id_ventas_temp = null, $data = null)
    {

        try{
            //debug($data);

            $ventas_temp = $this->VentasTemp->get($id_ventas_temp);

            //primero elimino la cantidad original
            $ventas_temp->subtotal = $ventas_temp->subtotal - (($data['cantidad'] * $data['precio']));
            $ventas_temp->descuentos = $ventas_temp->descuentos - (($data['cantidad'] * $data['descuento']));
            $ventas_temp->total =  $ventas_temp->subtotal - $ventas_temp->descuentos;

            //debug($ventas_temp);

            $ventas_temp->subtotal = $ventas_temp->subtotal + (($data['cantidad_new'] * $data['precio_new']));
            $ventas_temp->descuentos = $ventas_temp->descuentos + (($data['cantidad_new'] * $data['descuento_new']));
            $ventas_temp->total =  $ventas_temp->subtotal - $ventas_temp->descuentos;

            //debug($ventas_temp);

            if($this->VentasTemp->save($ventas_temp)) {

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
        return false;
    }


    public function viewVentasNotFinish($id_campaign = null)
    {

        //segun el tipo de usuario filtro o no
        $user = $this->Authentication->getIdentity();

        $ventas_temp_not_finish = null;

        if ($user->role == 'admin'){
            $ventas_temp_not_finish = $this->VentasTemp->find('all', [
                'contain' => ['Clientes']
            ])
                ->where(['status' => 0]);

        } else {
            $ventas_temp_not_finish = $this->VentasTemp->find('all', [
                'contain' => ['Clientes']
            ])
                ->where(['status' => 0, 'users_idusers' => $user->idusers]);

        }

        //($ventas_temp_not_finish->toArray());

        $this->set(compact('ventas_temp_not_finish'));
        $this->set(compact('id_campaign'));
    }


    public function delete($id_venta = null)
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);

        try{
            $venta_temp =  $this->VentasTemp->get($id_venta);

            if ($this->VentasTemp->delete($venta_temp)) {
                $this->Flash->success(__('El Registro ha sido eliminado.'));

                return $this->redirect($this->request->referer());
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


    public function selectTypePay($id_ventas_temp = null)
    {

        try{

            $ventas_temp = $this->VentasTemp->get($id_ventas_temp);

            if($this->request->is(['post', 'patch', 'put'])){

                $ventas_temp = $this->VentasTemp->patchEntity($ventas_temp, $this->request->getData());
                $ventas_temp->is_pay = $ventas_temp->cuenta_corriente == 1 ? 0 : 1;


                if($this->VentasTemp->save($ventas_temp)){

                    return $this->redirect(['controller' => 'Ventas', 'action' => 'addByVentaTemp', $id_ventas_temp]);
                }
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
        $this->set(compact('ventas_temp'));
    }




    private function _getStockCamionCampaign($id_campaign = null, $users_idusers = null)
    {

        $model_stock_camion_campaign = $this->getTableLocator()->get('StockCamionCampaign');

        $stock_camion_camp = $model_stock_camion_campaign->find('all', [
            'contain' => ['StockCampaignProducto' => function($q){
                return $q->contain(['Productos' => ['Categories', 'Subcategories', 'Proveedores', 'StockProductos']])
                    ->where(['status' => 1]);
            }

                ]
        ])->where(['campaign_idcampaign' => $id_campaign, 'users_idusers' => $users_idusers]);

        /*$stock_camion_camp = $model_stock_camion_campaign->find('all', [
            'contain' => ['StockCampaignProducto' => ['Productos' => ['Categories', 'Subcategories', 'Proveedores', 'StockProductos']]]
        ])->where(['campaign_idcampaign' => $id_campaign, 'users_idusers' => $users_idusers]);*/

        return $stock_camion_camp;


    }

    private function _getClientes()
    {
        $model_clientes = $this->getTableLocator()->get('Clientes');

        $clientes = $model_clientes->find('list', [
            'keyField' => 'idclientes',
            'valueField' => function($row){
                return $row['nombre'] . ' ' .$row['apellido'] . ' (' . $row['shop_name'] . ')';
            },
            'order' => ['nombre' => 'ASC']
        ]);

        return $clientes;

    }


    public function getTotalesProductos($id_ventas_temp = null)
    {
        $model_prodped = $this->getTableLocator()->get('ProductosVentasTemp');

        $total = $model_prodped->find('GetCantidadProductos', ['idventatemp' => $id_ventas_temp])->first();

        return $total;

    }

    public function setDescuentoGeneral($id_venta_temp = null)
    {
        if ($id_venta_temp == null)
        {
            $this->Flash->error(__('Error de acceso. Intenta nuevamente'));
            return $this->redirect($this->referer());
        } else {


            try {

                //Variable usada para el sidebar

                $venta_temp = $this->VentasTemp->get($id_venta_temp, []);
                $descuento_general = $venta_temp->descuento_general;

                $this->set(compact('venta_temp'));
                $this->set(compact('id_venta_temp'));

                if ($this->request->is(['patch', 'post', 'put'])){
                    $venta_temp = $this->VentasTemp->patchEntity($venta_temp, $this->request->getData());


                    //modifico tmb el total general
                    $venta_temp->total = $venta_temp->subtotal -  $venta_temp->descuentos -  $venta_temp->descuento_general;


                    if($this->VentasTemp->save($venta_temp)){

                        $this->Flash->success(__('El Descuento se almaceno correctamente.'));

                        return $this->redirect(['action' => 'view', $id_venta_temp]);
                    }


                }




            } catch (InvalidPrimaryKeyException $e) {
                //debug($e);

                $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

            } catch (RecordNotFoundException $e) {

                $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

            } catch (Exception $e) {

                $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
                //return false;
            }



        }

    }

    public function setToFalseVentaTemp($id_venta_temp = null)
    {
        $this->autoRender = false;
        try{

            $venta_temp = $this->VentasTemp->get($id_venta_temp);
            //$venta_temp->status = 1;

            if($this->VentasTemp->delete($venta_temp)){

                return true;

            }

            return false;

        } catch (InvalidPrimaryKeyException $e) {
            //debug($e);

            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

        } catch (RecordNotFoundException $e) {

            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

        } catch (Exception $e) {

            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
            //return false;
        }
        return false;



    }


}