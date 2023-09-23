<?php

namespace App\Manager;

use App\Entity\Client;
use Doctrine\Persistence\ManagerRegistry;

class ClientManager extends AbstractManager
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine);
        $this->repository = $this->em->getRepository(Client::class);
        $this->alias = 'c';
    }

    protected function setRepository()
    {
        $this->repository = $this->em->getRepository(Client::class);
    }

    protected function getRepository()
    {
        return $this->getRepository();
    }

    protected function setAlias()
    {
        $this->alias = 'c';
    }
}