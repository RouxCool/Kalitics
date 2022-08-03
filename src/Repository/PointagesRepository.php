<?php

namespace App\Repository;

use App\Entity\Pointages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\DateTime;

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

    public function findByMatricule($matricule): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.matricule = :matricule')
            ->setParameter('matricule', $matricule)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByChantier($chantier): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.chantier = :chantier')
            ->setParameter('chantier', $chantier)
            ->getQuery()
            ->getResult()
        ;
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

    public function findByMatriculeChantierDate($matricule, $chantier, $date): array
    {
        //$from = new DateTime($date->format("Y-m-d"));
        //$to   = new DateTime($date->format("Y-m-d"));
        return $this->createQueryBuilder('p')
            ->andWhere('p.matricule = :matricule')
            ->andWhere('p.chantier = :chantier')
            ->andWhere('p.date BETWEEN :from AND :to')
            ->setParameter('matricule', $matricule)
            ->setParameter('chantier', $chantier)
            ->setParameter('to', $date)
            ->setParameter('from', $date)
            ->getQuery()
            ->getResult()
        ;
    }

    /*public function findByAll(array $var): array
    {
        $req = $this->createQueryBuilder('p');
        foreach($var as $field => $value) {
            $req->andWhere('p.:field = :value');
            $req->setParameter('field', $field);
            $req->setParameter('value', $value);
        }
        $req->getQuery();
        $req->getResult();
        return $req;
    }*/

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
