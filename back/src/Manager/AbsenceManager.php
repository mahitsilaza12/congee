<?php

namespace App\Manager;

use App\Entity\Absence;
use Doctrine\Persistence\ManagerRegistry;

class AbsenceManager extends AbstractManager
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine);
        $this->repository = $this->em->getRepository(Absence::class);
        $this->alias = 'a';
    }

    protected function setRepository()
    {
        $this->repository = $this->em->getRepository(Absence::class);
    }

    protected function getRepository()
    {
        return $this->getRepository();
    }
    
    protected function setAlias()
    {
        $this->alias = 'a';
    }
}