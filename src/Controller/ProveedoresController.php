<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;

/**
 * Proveedores Controller
 *
 * @property \App\Model\Table\ProveedoresTable $Proveedores
 */
class ProveedoresController extends AppController
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
        $proveedores = $this->Proveedores->find('all', []);

        $this->set(compact('proveedores'));
    }

    public function add()
    {

        $proveedores = $this->Proveedores->newEmptyEntity();


        if ($this->request->is('post')) {

            $proveedores = $this->Proveedores->patchEntity($proveedores, $this->request->getData());
            if ($this->Proveedores->save($proveedores)) {
                $this->Flash->success(__('El Proveedor se almaceno correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El Proveedor no se pudo guardar. Intente nuevamente.'));

        }

        $this->set(compact('proveedores'));

    }

    public function edit($id = null)
    {
        try{

            $proveedores =  $this->Proveedores->get($id);
            $this->set(compact('proveedores'));


            if ($this->request->is(['patch', 'post', 'put'])) {
                $proveedores = $this->Proveedores->patchEntity($proveedores, $this->request->getData());
                if ($this->Proveedores->save($proveedores)) {
                    $this->Flash->success(__('El Proveedor se almaceno correctamente.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('El Proveedor no se pudo guardar. Intente nuevamente.'));

            }
            $this->set(compact('proveedores'));
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
            $clientes =  $this->Proveedores->get($id);

            if ($this->Proveedores->delete($clientes)) {
                $this->Flash->success(__('El Proveedor ha sido eliminado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El Proveedor no pudo ser eliminado. Intente nuevamente.'));
            }

        } catch (InvalidPrimaryKeyException $e){
            $this->Flash->error(__('El Proveedor no pudo ser eliminado. Intente nuevamente.'));

        } catch (RecordNotFoundException $e){
            $this->Flash->error(__('El Proveedor no pudo ser eliminado. Intente nuevamente.'));
        }
        catch (Exception $e){
            $this->Flash->error(__('El Proveedor no pudo ser eliminado. Intente nuevamente.'));
        }

    }
}
