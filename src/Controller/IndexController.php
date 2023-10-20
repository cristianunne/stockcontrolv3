<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Index Controller
 *
 */
class IndexController extends AppController
{


    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event); // TODO: Change the autogenerated stub
        $this->loadCartProduct();


    }


    public function index()
    {
        $model_campaign = $this->getTableLocator()->get('Campaign');

        $estado = true;
        $campaign = $model_campaign->find('all', [
            'contain' => []
        ])
            ->where(['status' => 1]);

        if($campaign->toArray() != null){
            $campaign = $campaign->first();

        } else {
            $estado = false;
        }

        $this->set(compact('estado'));
        $this->set(compact('campaign'));

    }

}
