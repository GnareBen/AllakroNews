<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function add(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Article[] Returns an array of Article objects
     */
    public function findByValid(): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.is_valid = true')
            ->andWhere('u.is_published = true')
            ->orderBy('u.created_at', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Article[] Returns an array size 6 of Article objects
     */
    public function findBySix(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.created_at', 'DESC')
            ->andWhere('a.is_valid = true')
            ->andWhere('a.is_published = true')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findLastOne(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->andWhere('a.is_valid = true')
            ->andWhere('a.is_published = true')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Article[] Returns an array size3 of Article objects
     */
//    public function findByTag(String $name): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.tag = :name')
//            ->setParameter('name', $name)
//            ->orderBy('a.tag', 'DESC')
//            ->setMaxResults(3)
//            ->getQuery()
//            ->getResult()
//            ;
//    }


//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
