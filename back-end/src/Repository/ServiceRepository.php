<?php

namespace App\Repository;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Service>
 *
 * @method Service|null find($id, $lockMode = null, $lockVersion = null)
 * @method Service|null findOneBy(array $criteria, array $orderBy = null)
 * @method Service[]    findAll()
 * @method Service[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Service::class);
    }

    public function add(Service $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Service $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function searchService(array $params, $page, $postsPerPage): array
    {
        $query = $this->createQueryBuilder('c');

        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult($postsPerPage * ($page - 1)) // Offset
            ->setMaxResults($postsPerPage); // Limit

        $data["list"] = $paginator->getQuery()->getResult();
        $data['total'] = (int)$query->select($query->expr()->countDistinct('c.id'))
            ->getQuery()
            ->getSingleScalarResult();

        return $data;
    }
}
