<?php

namespace App\Manager;

use App\Entity\Commande;
use Doctrine\Persistence\ManagerRegistry;

class CommandeManager extends AbstractManager
{

    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine);
        $this->repository = $this->em->getRepository(Commande::class);
        $this->alias = 'co';
    }

    protected function setRepository()
    {
        $this->repository = $this->em->getRepository(Commande::class);
    }

    protected function getRepository()
    {
        return $this->getRepository();
    }

    protected function setAlias()
    {
        $this->alias = 'co';
    }
}