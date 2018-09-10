<?php

namespace App\Repository;

use App\Entity\CardImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CardImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardImage[]    findAll()
 * @method CardImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CardImage::class);
    }

//    /**
//     * @return CardImage[] Returns an array of CardImage objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CardImage
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
