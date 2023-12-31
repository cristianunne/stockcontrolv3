<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\StockCampaignProducto;
use App\Utility\PedidosStatusEnum;
use Cake\Datasource\ConnectionManager;
use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;
use PDOException;

/**
 * Ventas Controller
 *
 * @property \App\Model\Table\VentasTable $Ventas
 */
class VentasController extends AppController
{


    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event); // TODO: Change the autogenerated stub
        $this->Authentication->addUnauthenticatedActions(['printVentaWithout']);

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

        $user = $this->Authentication->getIdentity();
        $ventas = null;
        if($user->role == 'admin'){
            $ventas = $this->Ventas->find('all',[
                'contain' => ['Productos', 'Clientes', 'Users']]);
        } else {
            $ventas = $this->Ventas->find('all',[
                'contain' => ['Productos', 'Clientes', 'Users']])
            ->where(['users_idusers' => $user->idusers]);
        }

        //debug($ventas->toArray());

        $this->set(compact('ventas'));


    }

    public function addByVentaTemp($id_venta_temp = null)
    {
        $this->autoRender = false;

        $model_venta_temp = $this->getTableLocator()->get('VentasTemp');
        $venta_temp = $model_venta_temp->get($id_venta_temp, [
            'contain' => ['ProductosVentasTemp']
        ]);

        //debug($venta_temp);


        $array = [
            'users_idusers' => $venta_temp->users_idusers,
            'clientes_idclientes' => $venta_temp->clientes_idclientes,
            'subtotal' => $venta_temp->subtotal,
            'descuentos' => $venta_temp->descuentos,
            'total' => $venta_temp->total,
            'descuento_general' => $venta_temp->descuento_general,
            'campaign_idcampaign' => $venta_temp->campaign_idcampaign,
            'created' => $venta_temp->created,
            'hash' => hash('sha256' , ('hash' . date("Y-m-d"))),
            'number' =>  $this->_getMaxNumberPedido() == null ? 1 : ($this->_getMaxNumberPedido() + 1),
            'cuenta_corriente' => $venta_temp->cuenta_corriente,
            'is_pay' => $venta_temp->is_pay,
            'camion_idcamion' => $venta_temp->camion_idcamion

        ];

        $productos_id_array = [];

        $productos_array = null;
        foreach ($venta_temp->productos_ventas_temp as $prod_venta)
        {
            $productos_array[] = [
                'productos_idproductos' => $prod_venta->productos_idproductos,
                'cantidad' => $prod_venta->cantidad,
                'precio_unidad' => $prod_venta->precio_unidad,
                'descuento_unidad' => $prod_venta->descuento_unidad,
                'created' => $prod_venta->created,
            ];
            $productos_id_array[] = $prod_venta->productos_idproductos;

        }

        $array['productos_ventas'] = $productos_array;

        /*$this->request->allowMethod(['post', 'delete']);

        $ventas = $this->Ventas->newEmptyEntity();

        $ventas = $this->Ventas->patchEntity($ventas, $array, [
            'associated' => ['ProductosVentas' =>['validate'=>false]]
        ]);*/


            //antes de cualquier venta compruebo la cantidad del stock total
            $is_stock = true;
            $productos_controller = new ProductosController();

            foreach ($array['productos_ventas'] as $prod)
            {
                $cantidad = $this->_getStockGeneralByProducto($prod['productos_idproductos'])->cantidad;

                $pedido = $productos_controller->getProductById2($prod['productos_idproductos']);


                if($prod['cantidad'] > $cantidad){
                    //debug('Error al almacenar los cambios. La Venta Supera el Stock Disponible para ' . $pedido->name);
                    $this->Flash->error(__('Error Procesar la Venta. La Venta Supera el Stock Disponible para ' . $pedido->name .  ' Stock Disponible: (' . $cantidad . ')'));
                    $is_stock = false;
                }


            }

            if(!$is_stock){
                return $this->redirect(['controller' => 'VentasTemp', 'action' => 'view', $id_venta_temp]);
            }


            $conn = ConnectionManager::get('default');
            $conn->begin();
            if ($this->addVenta(json_encode($array))){

                //seteo la venta a true
                $ventas_temp_controller = new VentasTempController();
                if($ventas_temp_controller->setToFalseVentaTemp($id_venta_temp)){

                    $stock_controller = new StockProductosController();
                    if ($stock_controller->updateStockByVenta($productos_id_array, $array))
                    {
                        $conn->commit();

                        $venta = $this->Ventas->find('all', [])->last();


                        $this->Flash->success(__('La Venta se ha concretado correctamente'));
                        return $this->redirect(['controller' => 'Ventas', 'action' => 'view', $venta->idventas]);
                    }

                }

            }

            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
            $conn->rollback();







    }


    public function addVenta($json_data = null)
    {
        $data = json_decode($json_data, true);
        //antes de almacenar debo consultar los stock de los productos y cambiar tanto del camion como el general
        //consulto el stock general primero de los primeros

        $stock_camion_campaign = $this->_getStockCamionCampaign($data['campaign_idcampaign']);

        $stock_camp_prod_controller = new StockCampaignProductoController();

        $result_stock_camion = false;


        foreach ($data['productos_ventas'] as $prod)
        {

            if (!$stock_camp_prod_controller->updateStockCamion($stock_camion_campaign->idstock_camion_campaign, $prod['productos_idproductos'],
            $prod['cantidad'])) {
                $result_stock_camion = false;
                break;
            }
            $result_stock_camion = true;
        }

        if($result_stock_camion){
            $venta = $this->Ventas->newEmptyEntity();
            $venta = $this->Ventas->patchEntity($venta, $data, [
                'associated' => ['ProductosVentas' =>['validate'=>false]]
            ]);

            if($this->Ventas->save($venta)){
                return true;
            }
            return false;
        }

        return false;

    }

    public function view($idventa = null)
    {

        $ventas = $this->Ventas->get($idventa,[
            'contain' => ['Productos' => ['Categories', 'Subcategories'], 'Clientes', 'Users', 'Devoluciones' => ['Productos' => ['Categories', 'Subcategories']]]]);


        $totales = $this->getTotales($idventa);
        $cant_productos = $this->getTotalesProductos($idventa)->suma;

        $this->set(compact('ventas'));
        $this->set(compact('totales'));
        $this->set(compact('cant_productos'));
        $this->set(compact('idventa'));
    }

    public function addVentaByPedido($id_pedido = null)
    {

        if ($id_pedido != null){

            try {
                $conn = ConnectionManager::get('default');
                $conn->begin();

                $pedido = $this->_getPedidoById($id_pedido);

                $venta = $this->Ventas->newEmptyEntity();

                $venta->subtotal = $pedido->subtotal;
                $venta->descuentos = $pedido->descuentos;
                $venta->total = $pedido->total;
                $venta->descuento_general = $pedido->descuento_general;
                $venta->clientes_idclientes = $pedido->clientes_idclientes;
                $venta->pedidos_idpedidos = $pedido->idpedidos;
                $venta->users_idusers = $this->Authentication->getIdentity()->idusers;

                $venta->hash = hash('sha256' , ('venta' . date("Y-m-d")));

                //traigo el max number del pedido
                $venta->number = $this->_getMaxNumberPedido() == null ? 1 : ($this->_getMaxNumberPedido() + 1);

                $venta->productos = $pedido->productos;


                if ($this->Ventas->save($venta, [
                    'associated' => ['Productos']
                ])){

                    //seteo el pedido a COmpletado
                    $pedidos_controller = new PedidosController();

                    if ($pedidos_controller->changeStatusByStatus($id_pedido,PedidosStatusEnum::COMPLETED)){
                        $conn->commit();
                        $this->Flash->success(__('Se ha concretado la Venta correctamente.'));

                        return $this->redirect(['controller' => 'Ventas', 'action' => 'index']);

                    }


                } else {
                    $this->Flash->error(__('Error al crear la Venta. Intenta nuevamente'));
                    $conn->rollback();
                    return  $this->redirect($this->request->referer());
                }





            } catch (InvalidPrimaryKeyException $e) {
                //debug($e);

                $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
                return  $this->redirect($this->request->referer());

            } catch (RecordNotFoundException $e) {
                //debug($e);
                $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
                return  $this->redirect($this->request->referer());
            } catch (PDOException $e) {
                //debug($e);
                $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
                return  $this->redirect($this->request->referer());
            }


        }


    }

    private function _getPedidoById($id_pedido = null)
    {

        $pedido_model = $this->getTableLocator()->get('Pedidos');

        $pedido = $pedido_model->get($id_pedido, [
            'contain' => ['Productos']
        ]);

        return $pedido;

    }


    private function _getMaxNumberPedido()
    {
        $model_pedidos = $this->getTableLocator()->get('Ventas');

        return $model_pedidos->find('GetMaxNumberPedidos', [])->first()->max;

    }

    public function getTotales($id_venta = null)
    {
        //$this->autoRender = false;
        $this->layout = 'empty';
        //debug($id_pedido);

        //Traigo los productos usando el pedido
        $model_prodped = $this->getTableLocator()->get('ProductosVentas');


        $subtotal = $model_prodped->find('GetTotales', ['pedidos_idpedidos' => $id_venta])->first();

        //traigo el totl
        return $subtotal;
    }

    public function getTotalesProductos($id_venta = null)
    {
        $model_prodped = $this->getTableLocator()->get('ProductosVentas');

        $total = $model_prodped->find('GetCantidadProductos', ['id_venta' => $id_venta])->first();

        return $total;

    }

    private function _getStockCamionCampaign($id_campaign = null)
    {

        $this->autoRender = false;

        $id_user =  $user = $this->Authentication->getIdentity()->idusers;


        $stock_camion_campaign_model = $this->getTableLocator()->get('StockCamionCampaign');

        $camion_campaign = $stock_camion_campaign_model->find('all', [
        ])
            ->where(['campaign_idcampaign' => $id_campaign, 'users_idusers' => $id_user])->first();

        return $camion_campaign;


    }

    private function _getStockGeneralByProducto($id_producto = null)
    {
        $stock_controller = new StockProductosController();

        return $stock_controller->getStockByProducto($id_producto);

    }

    public function printVenta($idventa = null)
    {

        $ventas = $this->Ventas->get($idventa,[
            'contain' => ['Productos' => ['Categories', 'Subcategories'], 'Clientes', 'Users']]);


        $totales = $this->getTotales($idventa);
        $cant_productos = $this->getTotalesProductos($idventa)->suma;

        $this->set(compact('ventas'));
        $this->set(compact('totales'));
        $this->set(compact('cant_productos'));
        $this->set(compact('idventa'));


    }

    public function printVentaWithout($idventa = null)
    {

        $ventas = $this->Ventas->get($idventa,[
            'contain' => ['Productos' => ['Categories', 'Subcategories'], 'Clientes', 'Users']]);


        $totales = $this->getTotales($idventa);
        $cant_productos = $this->getTotalesProductos($idventa)->suma;

        $this->set(compact('ventas'));
        $this->set(compact('totales'));
        $this->set(compact('cant_productos'));
        $this->set(compact('idventa'));


    }


    public function modifiedByDevolucion($idventa = null, $idproducto = null, $cantidad = null)
    {
        $this->autoRender = false;
        try {

            $venta = $this->Ventas->get($idventa, [
                'contain' => ['ProductosVentas' => function ($q) use ($idproducto) {
                    return $q->where(['productos_idproductos' => $idproducto]);
                }]
            ]);

            $venta->subtotal = $venta->subtotal - ($cantidad * $venta->productos_ventas[0]->precio_unidad);
            $venta->descuentos = $venta->descuentos - ($cantidad * $venta->productos_ventas[0]->descuento_unidad);

            $venta->total = $venta->subtotal - $venta->descuentos - $venta->descuento_general;

            $venta->productos_ventas[0]->cantidad = $venta->productos_ventas[0]->cantidad - $cantidad;

            $venta = $this->Ventas->patchEntity($venta, $venta->toArray());

            if($this->Ventas->save($venta, [
                'associated' => ['ProductosVentas']])){
                return true;
            }

            return false;


        } catch (InvalidPrimaryKeyException $e) {

         return false;

        } catch (RecordNotFoundException $e) {
            return false;
        } catch (PDOException $e) {
            return false;
        }



    }


    public function delete($idventa = null)
    {
        try{

            $venta = $this->Ventas->get($idventa);


        } catch (InvalidPrimaryKeyException $e){
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

        } catch (RecordNotFoundException $e){
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
        }
        catch (Exception $e){
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
        }

    }

}
