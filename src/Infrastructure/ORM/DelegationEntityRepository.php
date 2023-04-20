<?php

declare(strict_types=1);

namespace App\Infrastructure\ORM;

use App\Application\Query\DelegationQuery;
use App\Domain\Delegation\Delegation;
use App\Domain\Delegation\DelegationRepository;
use App\Domain\User\User;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DelegationEntityRepository implements DelegationRepository
{

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Delegation $delegation): void
    {
        $this->entityManager->persist($delegation);
        $this->entityManager->flush();
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

    public function getDelegationsByUser(User $user): DelegationQuery
    {
          $query = $this->entityManager->createQueryBuilder()
            ->where('user = :user')
            ->setParameter('user', $user)
            ->orderBy('startDelegation')
            ->getQuery()
            ->getResult();

    }

    public function findDuplicateDelegationInSameTimeForUser(
        \DateTimeImmutable $startDelegation,
        \DateTimeImmutable $endDelegation,
        int                $user
    ): DelegationQuery
    {
        return $this->entityManager->createQueryBuilder()
            ->where('d.user = :user')
            ->andWhere('startDelegation <= :endDelegation AND d.endDelegation >=:startDelegation')
            ->orWhere('startDelegation >= :startDelegation AND d.endDelegation <= :endDelegation')
            ->orWhere('startDelegation <= :startDelegation AND d.endDelegation >= :endDelegation')
            ->setParameter('user', $user)
            ->setParameter('startDelegation', $startDelegation)
            ->setParameter('endDelegation', $endDelegation)
            ->getQuery()
            ->getResult();
    }
}
