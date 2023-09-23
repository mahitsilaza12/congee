<?php

namespace App\Manager;

use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;

class ProduitManager extends AbstractManager
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine);
        $this->repository = $this->em->getRepository(Produit::class);
        $this->alias = 'p';
    }

    protected function setRepository()
    {
        $this->repository = $this->em->getRepository(Produit::class);
    }

    protected function getRepository()
    {
        return $this->getRepository();
    }

    protected function setAlias()
    {
        $this->alias = 'p';
    }
}