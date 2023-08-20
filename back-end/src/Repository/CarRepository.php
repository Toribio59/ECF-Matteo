<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function add(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function searchCar(array $params, ?int $page, ?int $postsPerPage): array
    {
        $query = $this->createQueryBuilder('c');

        if (isset($params['title'])) {
            $query->andWhere('c.title LIKE :title')
                ->setParameter('title', '%' . $params['title'] . '%');
        }

        // price from - to 
        if (isset($params['priceFrom'])) {
            $query->andWhere('c.price >= :priceFrom')
                ->setParameter('priceFrom', $params['priceFrom']);
        }

        if (isset($params['priceTo'])) {
            $query->andWhere('c.price <= :priceTo')
                ->setParameter('priceTo', $params['priceTo']);
        }

        // manufacture year from - to

        if (isset($params['manufactureYearFrom'])) {
            $query->andWhere('c.manufactureYear >= :manufactureYearFrom')
                ->setParameter('manufactureYearFrom', $params['manufactureYearFrom']);
        }

        if (isset($params['manufactureYearTo'])) {
            $query->andWhere('c.manufactureYear <= :manufactureYearTo')
                ->setParameter('manufactureYearTo', $params['manufactureYearTo']);
        }

        // mileage from - to

        if (isset($params['mileageFrom'])) {
            $query->andWhere('c.mileage >= :mileageFrom')
                ->setParameter('mileageFrom', $params['mileageFrom']);
        }

        if (isset($params['mileageTo'])) {
            $query->andWhere('c.mileage <= :mileageTo')
                ->setParameter('mileageTo', $params['mileageTo']);
        }

        //results paginated 

        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult($postsPerPage * ($page - 1))
            ->setMaxResults($postsPerPage);
            
        $data['list'] = $paginator->getQuery()->getResult();
        $data['total'] = (int)$query->select($query->expr()->countDistinct('c.id'))
            ->getQuery()
            ->getSingleScalarResult();
            return $data;
    }
}
