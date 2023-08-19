<?php
namespace App\Policy;

use Authorization\Policy\RequestPolicyInterface;
use Cake\Http\ServerRequest;

class RequestPolicy implements RequestPolicyInterface
{
    /**
     * Method to check if the request can be accessed
     *
     * @param \Authorization\IdentityInterface|null $identity Identity
     * @param \Cake\Http\ServerRequest $request Server Request
     * @return bool
     */
    public function canAccess($identity, ServerRequest $request)
    {



        if (isset($identity))
        {
            if ($identity->role === 'admin')
            {
                return true;
            }
        }

        if ($request->getParam('controller') === 'Users')
        {
            if(isset($identity->role))
            {
                if($identity->role === 'admin'){
                    return true;
                } elseif ($identity->role === 'user'){
                    if ($request->getParam('action') === 'index' or $request->getParam('action') === 'logout')
                    {
                        return true;
                    }

                    return false;
                }
            }
            return false;

        } elseif($request->getParam('controller') === 'Index'){
            if(!isset($identity)){
                return true;
            }

        }

        return false;
    }
}
