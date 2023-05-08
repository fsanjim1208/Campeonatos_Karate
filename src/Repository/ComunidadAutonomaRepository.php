<?php

namespace App\Repository;

use App\Entity\ComunidadAutonoma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ComunidadAutonoma>
 *
 * @method ComunidadAutonoma|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComunidadAutonoma|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComunidadAutonoma[]    findAll()
 * @method ComunidadAutonoma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComunidadAutonomaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComunidadAutonoma::class);
    }

    public function save(ComunidadAutonoma $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ComunidadAutonoma $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByNombre($value): ?ComunidadAutonoma
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.Nombre = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

//    /**
//     * @return ComunidadAutonoma[] Returns an array of ComunidadAutonoma objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ComunidadAutonoma
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
