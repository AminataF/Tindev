<?php

namespace App\Repository;

use App\Entity\YearExperience;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<YearExperience>
 *
 * @method YearExperience|null find($id, $lockMode = null, $lockVersion = null)
 * @method YearExperience|null findOneBy(array $criteria, array $orderBy = null)
 * @method YearExperience[]    findAll()
 * @method YearExperience[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YearExperienceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, YearExperience::class);
    }

//    /**
//     * @return YearExperience[] Returns an array of YearExperience objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('y')
//            ->andWhere('y.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('y.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?YearExperience
//    {
//        return $this->createQueryBuilder('y')
//            ->andWhere('y.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
