<?php

namespace CoreBundle\Service;

use CoreBundle\Entity\Users;

class UserService extends AbstractService
{
    public function insert( Users $user)
    {
        return $this->getRepository("CoreBundle:Users")->insert($user);;
    }
}