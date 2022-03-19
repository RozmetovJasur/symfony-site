<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function filterQueryBuilder(array $params)
    {
        $qb = $this->createQueryBuilder('o')
            ->where('o.is_publish = true')
            ->orderBy('o.title');

        if (isset($params['name']) && !empty($params['name'])) {
            $qb
                ->andWhere('o.title like :name')
                ->setParameter('name', '%' . mb_strtolower($params['name']) . '%');
        }
        return $qb;
    }

    public function findById(array $ids): \Doctrine\ORM\QueryBuilder
    {
        $query = $this->createQueryBuilder('s')
            ->orderBy('s.id', 'DESC');

        $query->where('s.id in (:ids)')
            ->setParameter('ids', $ids);

        return $query;
    }

}
