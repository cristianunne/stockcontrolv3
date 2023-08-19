<?php

namespace App\Policy;

use Authorization\Policy\BeforePolicyInterface;

class IndexPolicy implements BeforePolicyInterface
{
    public function before($user, $resource, $action)
    {
        if ($user->getOriginalData()->role === 'admin') {
            return true;
        }
        // fall through

    }
}
