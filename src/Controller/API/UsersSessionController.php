<?php
declare(strict_types=1);

namespace App\Controller\API;

use App\Controller\AppController;

/**
 * UsersSession Controller
 *
 * @property \App\Model\Table\UsersSessionTable $UsersSession
 */
class UsersSessionController extends AppController
{

    public function add($user)
    {
        $this->autoRender = false;
        $user_s = $this->checkExist($user->idusers);
        if ($user_s){

            if($this->delete($user_s)){

                $new_user_s = $this->UsersSession->newEmptyEntity();
                $new_user_s = $user->idusers;

            }

        }


    }


    private function delete($user_session)
    {
        $this->autoRender = false;

        $user_s = $this->UsersSession->get($user_session->idusers_session);

        if($this->UsersSession->delete($user_s)){
            return true;
        }

        return false;
    }


    private function checkExist($id_user = null)
    {
        $user_ses = $this->UsersSession->find('all', [])
            ->where(['users_idusers' => $id_user])->first();

        if($user_ses == null){
            return false;
        }

        return $user_ses;

    }
}
