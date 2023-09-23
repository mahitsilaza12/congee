<?php

namespace App\Manager;

use App\Entity\DeleteCommand;
use Doctrine\Persistence\ManagerRegistry;

class DeleteCommandeManager extends AbstractManager
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine);
        $this->repository = $this->em->getRepository(DeleteCommand::class);
        $this->alias = 'dc';
    }

    protected function setRepository()
    {
        $this->repository = $this->em->getRepository(DeleteCommand::class);
    }

    protected function getRepository()
    {
        return $this->getRepository();
    }

    protected function setAlias()
    {
        $this->alias = 'dc';
    }
}