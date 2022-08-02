<?php

namespace App\Repository;

use App\Entity\Pointages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pointages>
 *
 * @method Pointages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pointages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pointages[]    findAll()
 * @method Pointages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pointages::class);
    }

    public function add(Pointages $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Pointages $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByMatriculeChantier($matricule, $chantier): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.matricule = :matricule')
            ->andWhere('p.chantier = :chantier')
            ->setParameter('matricule', $matricule)
            ->setParameter('chantier', $chantier)
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Pointages[] Returns an array of Pointages objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Pointages
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
