<?php

namespace App\Repository;

use App\Entity\Visite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Visite>
 *
 * @method Visite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visite[]    findAll()
 * @method Visite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visite::class);
    }
    /**
     * @param type $champ
     * @param type $ordre
     * @return Visite[]
     */
    public function findAllOrderBy($champ, $ordre) : array{
        return $this->createQueryBuilder('v')
        ->orderBy('v.'.$champ, $ordre)
        ->getQuery()
        ->getResult();
    }
    /**
     * @param type $champ
     * @param type $valeur
     * @return Visite[]
     */
    public function findByEqualValue($champ, $valeur) : array{
        if($valeur==""){
            return $this->createQueryBuilder('v') //alias de la table donné
            ->orderBy('v.'.$champ, 'ASC')
            ->getQuery()
            ->getResult();
        }else{
            return $this->createQueryBuilder('v') //alias de la table donné
            ->where('v.'.$champ.'=:valeur')
            ->setParameter('valeur', $valeur)
            ->orderBy('v.datecreation', 'DESC')
            ->getQuery()
            ->getResult();
        }
    }
    /**
     * @param Visite $entity
     * @param bool $flush
     */
    public function add($entity, $flush = false) : void{
        $this->getEntityManager()->persist($entity);
        if($flush){
            $this->getEntityManager()->flush();
        }
    }
    /**
     * @param Visite $entity
     * @param bool $flush
     */
    public function remove($entity, $flush = false) : void{
        $this->getEntityManager()->remove($entity);
        if($flush){
            $this->getEntityManager()->flush();
        }
    }
//    /**
//     * @return Visite[] Returns an array of Visite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Visite
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
