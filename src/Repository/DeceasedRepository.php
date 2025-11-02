<?php

namespace App\Repository;

use App\DTO\FilterDeceasedRequest;
use App\Entity\Deceased;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Deceased>
 */
class DeceasedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deceased::class);
    }

    //    /**
    //     * @return Deceased[] Returns an array of Deceased objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Deceased
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function findAllByFilter(FilterDeceasedRequest $filter): mixed
    {
        $queryBuilder = $this->createQueryBuilder('deceased');
        $queryBuilder->leftJoin('deceased.local','local');
        $queryBuilder->leftJoin('deceased.locker','locker');

        $queryBuilder->select('deceased', 'local', 'locker');
        if(! is_null($filter->fullName)){
            $queryBuilder->andWhere("LOWER(deceased.name) LIKE :full_name")
                ->setParameter('full_name', '%' . strtolower(str_replace(" ", "%", $filter->fullName)). '%');
        }
        if(! is_null($filter->dateOfDeath)){
            $queryBuilder->andWhere("deceased.date_of_death  = :date_of_death")
                ->setParameter('date_of_death', $filter->dateOfDeath);
        }
        if(! is_null($filter->block)){
            $queryBuilder->andWhere(
                $queryBuilder->expr()
                    ->orX(
                        'local.block =  :block'
                    ))
            ->setParameter('block', $filter->block);
        }
        if(! is_null($filter->section)){
            $queryBuilder->andWhere(
                $queryBuilder->expr()
                    ->orX(
                        'local.section =  :section'
                    ))
                ->setParameter('section', $filter->section);
        }
        if(! is_null($filter->typeBurialLocation)){
            $queryBuilder->andWhere(
                $queryBuilder->expr()
                    ->orX(
                        'local.type =  :type'
                    ))
                ->setParameter('type', $filter->typeBurialLocation);
        }
        if(! is_null($filter->created_at_start)){
            $queryBuilder->andWhere('deceased.date_of_death >= :date_start')
                ->setParameter('date_start', $filter->created_at_start);
        }
        if(! is_null($filter->created_at_start)){
            $queryBuilder->andWhere('deceased.date_of_death <= :date_end')
                ->setParameter('date_end', $filter->created_at_end);
        }

        $queryBuilder->orderBy('deceased.name', 'ASC');
//        dd($queryBuilder->getQuery()->getParameters());
        return $queryBuilder->getQuery()->getResult();
    }
}
