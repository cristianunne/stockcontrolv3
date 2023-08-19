<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\FilesManager;
use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;
use Cake\ORM\Query;

/**
 * Productos Controller
 *
 * @property \App\Model\Table\ProductosTable $Productos
 */
class ProductosController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event); // TODO: Change the autogenerated stub

        $this->Authentication->addUnauthenticatedActions(['login']);

        $user = $this->Authentication->getIdentity();
        if(isset($user) and $user->role === 'user')
        {
            if (!in_array($this->request->getParam('action'), ['index', 'edit'])) {
                //$this->redirect($this->request->referer());
                $this->Flash->error('Usted no esta autorizado para acceder al Sitio Solicitado');
                $this->redirect(['controller' => 'Index', 'action' => 'index']);
            }

        }
    }

    public $paginate = [
        // Other keys here.
        'maxLimit' => 8
    ];

    /**
     * @return void
     */
    public function index()
    {

        $productos = $this->Productos->find('all', [
            'contain' => ['Categories']
        ]);

        $productos = $this->paginate($productos);

        //debug($productos->toArray());

        $this->set(compact('productos'));


    }


    public function add()
    {

        $producto = $this->Productos->newEmptyEntity();

        $model_categories = $this->getTableLocator()->get('Categories');

        $categories = $model_categories->find('list',
            [
                'keyField' => 'idcategories',
                'valueField' => 'name',
                'order' => ['name' => 'ASC']
            ])->toArray();

        $this->set(compact('categories'));


        if ($this->request->is('post')) {


            //Almaceno la imagen que se cargara con el producto
            $data = $this->request->getData();
            $producto = $this->Productos->patchEntity($producto, $data);

            //imagen vacia
            if($data['file']['name'] != '')
            {
                //limito a 2bm la subida de las imagenes
                if(($data['file']['size'] / 1024) > 5096)
                {
                    //Excedi los 2 MB, informo
                    $this->Flash->error(__('Seleccione una imágen con un tamaño inferior a 5MB'));
                } else {

                    //procedo a trabajar porque cumplio las funciones
                    //Llamo al controlador de archivos
                    $filesManager = new FilesManager();
                    $result_save = $filesManager->uploadFiles($data['file'], IMG_PRODUCTS);

                    if (!$result_save)
                    {
                        $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
                    } else {

                        $producto->photo = $result_save;
                        $producto->folder = IMG_PRODUCTS_SHORT;
                        debug($producto);

                        if($this->Productos->save($producto)){

                            $this->Flash->success(__('El Producto se ha almacenado correctamente'));
                            //traigo los datos nuevamente y actualizo el current user

                            return $this->redirect(['action' => 'index']);
                        }

                    }

                }


            } else {
                //COmo no vino una imagen, guardo igual
                if ($this->Productos->save($data)){

                    $this->Flash->success(__('El Producto se ha almacenado correctamente'));
                    //traigo los datos nuevamente y actualizo el current user

                    return $this->redirect(['action' => 'index']);
                }
            }




            $producto = $this->Productos->patchEntity($producto, $this->request->getData());
            if ($this->Productos->save($producto)) {
                $this->Flash->success(__('El producto se almaceno correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El Producto no se pudo guardar. Intente nuevamente.'));

        }

        $this->set(compact('producto'));

    }


    public function viewConfig($id = null)
    {

        try {

            $producto = $this->Productos->get($id, [
                'contain' => ['Categories', 'Subcategories', 'Precios' => function(Query $q){

                    return $q->where(['active' => 1]);
                }]
            ]);

            //debug($producto);

            //traigo los precios
            $precios = $this->getPricesByProduct($id);


            $this->set(compact('producto'));
            $this->set(compact('precios'));

        } catch (InvalidPrimaryKeyException $e){
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

        } catch (RecordNotFoundException $e){
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

        }
        catch (Exception $e){
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

        }
    }


    public function getSubCategoriesByCategory()
    {

        $id = $_GET['category'];

        $subcategoriesController = new SubcategoriesController();

        return $subcategoriesController->getSubCategoriesByCategory($id);


    }


    public function getProductById()
    {

        //return $this->json(['result' => false]);

        $data = $this->request->getData();
        $producto_id = $data['producto_id'];


        //comprobacion de definicion de variable
        if ($producto_id != null) {

            $productos = $this->Productos->find('all', [

                ]
            )
                ->where(['idproductos' => $producto_id])
                ->toArray();

            //puedo agregar desde aqui
            if($this->addProductoToCartSession( $producto_id)){

                return $this->json($productos);
            }

            return $this->json(['result' => false]);

        }

        return $this->json(['result' => false]);


    }


    public function addProductoToCartSession($producto_id)
    {

        $model_cart_session = $this->getTableLocator()->get('CartSession');

        $product = $model_cart_session->newEmptyEntity();

        $user = $this->Authentication->getIdentity();

        $product->productos_idproductos = $producto_id;
        $product->users_idusers = $user->idusers;

        if($model_cart_session->save($product)){
            return true;
        }

        return false;
    }


    private function getPricesByProduct($id = null)
    {

        if ($id == null){
            return null;
        } else {

            try{

                $model_precios = $this->getTableLocator()->get('Precios');

                $precio =  $model_precios->find('all', [
                    'order' => ['active' => 'DESC']
                ])
                ->where(['productos_idproductos' => $id]);
               // debug($precio->toArray());
                return $precio;


            } catch (InvalidPrimaryKeyException $e){
                return null;
            } catch (RecordNotFoundException $e){
                return null;
            }
            catch (Exception $e){
                return null;

            }
        }

    }



    public function deletePriceById($id = null)
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);

        try{
            $model_precios = $this->getTableLocator()->get('Precios');
            $precios =  $model_precios->get($id);

            if ($model_precios->delete($precios)) {
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

}