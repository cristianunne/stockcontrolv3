<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class CategoriesController extends AppController
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

        $categorias = $this->Categories->find('all', []);

        $this->set(compact('categorias'));




    }

    public function add()
    {

        $categories = $this->Categories->newEmptyEntity();

        if ($this->request->is('post')) {

            $categories = $this->Categories->patchEntity($categories, $this->request->getData());
            if ($this->Categories->save($categories)) {
                $this->Flash->success(__('La Categoria se almaceno correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La Categoria no se pudo guardar. Intente nuevamente.'));

        }

        $this->set(compact('categories'));

    }

    public function edit($id = null)
    {
        try{

            $categories =  $this->Categories->get($id);
            $this->set(compact('categories'));


            if ($this->request->is(['patch', 'post', 'put'])) {
                $categories = $this->Categories->patchEntity($categories, $this->request->getData());
                if ($this->Categories->save($categories)) {
                    $this->Flash->success(__('La Categoria se almaceno correctamente.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('La Categoria no se pudo guardar. Intente nuevamente.'));

            }
            $this->set(compact('categories'));
        } catch (InvalidPrimaryKeyException $e){
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));

        } catch (RecordNotFoundException $e){
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
        }
        catch (Exception $e){
            $this->Flash->error(__('Error al almacenar los cambios. Intenta nuevamente'));
        }
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        try{
            $categories =  $this->Categories->get($id);

            if ($this->Categories->delete($categories)) {
                $this->Flash->success(__('El Registro ha sido eliminado.'));

                return $this->redirect(['action' => 'index']);
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
