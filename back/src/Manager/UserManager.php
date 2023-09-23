<?php

namespace App\Manager;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;

class UserManager extends AbstractManager
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine);
        $this->repository = $this->em->getRepository(User::class);
        $this->alias = 'u';
    }

    protected function setRepository()
    {
        $this->repository = $this->em->getRepository(User::class);
    }

    protected function getRepository()
    {
        return $this->getRepository();
    }

    protected function setAlias()
    {
        $this->alias = 'u';
    }
}
