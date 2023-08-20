<?php

namespace App\Repository;

use App\Entity\Testimonial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Testimonial>
 *
 * @method Testimonial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Testimonial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Testimonial[]    findAll()
 * @method Testimonial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestimonialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Testimonial::class);
    }

    public function add(Testimonial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Testimonial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function searchTestimonal(array $params, $page, $postsPerPage): array
    {
        $query = $this->createQueryBuilder('c');

        if (isset($params['ratings'])) {
            $params['ratings'] = explode(',', $params['ratings']);

            $query->andWhere('c.rating IN (:ratings)')
                ->setParameter('ratings', $params['ratings']);  
        }

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
