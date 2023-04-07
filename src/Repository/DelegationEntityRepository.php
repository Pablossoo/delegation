<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Delegation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Delegation>
 *
 * @method Delegation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Delegation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Delegation[]    findAll()
 * @method Delegation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class DelegationEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Delegation::class);
    }

    public function save(Delegation $entity): void
    {
        $this->getEntityManager()
            ->persist($entity);
        $this->getEntityManager()
            ->flush();
    }

    public function remove(Delegation $entity, bool $flush = false): void
    {
        $this->getEntityManager()
            ->remove($entity);

        if ($flush) {
            $this->getEntityManager()
                ->flush();
        }
    }

    public function getDelegationsByUser(int $user): array
    {
        return $this->createQueryBuilder('d')
            ->where('d.user = :user')
            ->setParameter('user', $user)
            ->orderBy('d.startDelegation')
            ->getQuery()
            ->getResult();
    }

    public function findDuplicateDelegationInSameTimeForUser(
        \DateTimeImmutable $startDelegation,
        \DateTimeImmutable $endDelegation,
        int $user
    ) {
        return $this->createQueryBuilder('d')
            ->where('d.user = :user')
            ->andWhere('d.startDelegation <= :endDelegation AND d.endDelegation >=:startDelegation')
            ->orWhere('d.startDelegation >= :startDelegation AND d.endDelegation <= :endDelegation')
            ->orWhere('d.startDelegation <= :startDelegation AND d.endDelegation >= :endDelegation')
            ->setParameter('user', $user)
            ->setParameter('startDelegation', $startDelegation)
            ->setParameter('endDelegation', $endDelegation)
            ->getQuery()
            ->getResult();
    }
}
