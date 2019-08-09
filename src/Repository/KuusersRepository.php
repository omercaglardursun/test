<?php

namespace App\Repository;

use App\Entity\Kuusers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Kuusers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kuusers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kuusers[]    findAll()
 * @method Kuusers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KuusersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Kuusers::class);
    }

    // /**
    //  * @return Kuusers[] Returns an array of Kuusers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kuusers
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
