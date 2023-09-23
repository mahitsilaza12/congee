<?php

namespace App\Manager;

use App\Entity\Congee;
use Doctrine\Persistence\ManagerRegistry;

class CongeeManager extends AbstractManager
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine);
        $this->repository = $this->em->getRepository(Congee::class);
        $this->alias = 'c';
    }

    protected function setRepository()
    {
        $this->repository = $this->em->getRepository(Congee::class);
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