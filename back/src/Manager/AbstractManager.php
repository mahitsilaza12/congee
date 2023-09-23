<?php
/**
 * User: oskar fabriola davidson
 * Date: 24/03/2023
 * Time: 18:24
 */

namespace App\Manager;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

abstract class AbstractManager
{
    const NB_PER_PAGE = 4;

    public $repository;
    public $alias;
    public $em;

    abstract protected function setRepository();
    abstract protected function setAlias();
    abstract protected function getRepository();

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
    }

    public function findByParam($params = [], $page = 1)
    {
        $repos = $this->repository;

        $qb = $repos->createQueryBuilder($this->alias)
                    ->orderBy($this->alias.'.id', 'ASC' );
        foreach($params as $key => $value) {
            $qb->andwhere($this->alias .'.'. $key .' =:_' . $key)
               ->setParameter(':_' . $key, $value);
        }
        $query = $qb->getQuery();

        $paginator = new Paginator($query);

        // get total items
        $totalItems = count($paginator);

        // get total page
        $pagesCount = ceil($totalItems / self::NB_PER_PAGE);

        $paginator->getQuery()
                  ->setFirstResult(self::NB_PER_PAGE * ($page-1))
                  ->setMaxResults(self::NB_PER_PAGE);
        $aDatas = [];
        foreach($paginator as $pagesItem) {
            $aDatas[] = $pagesItem; 
        }
        return [$aDatas, $totalItems, $pagesCount];

    }
}