<?php

declare(strict_types=1);

namespace App\Infrastructure\ORM;

use App\Domain\User\User;
use App\Domain\User\UseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

final class UserRepository implements UseRepository
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }
    public function save(User $entity): void
    {
        $this->getEntityManager()
            ->persist($entity);
        $this->getEntityManager()
            ->flush();
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()
            ->remove($entity);

        if ($flush) {
            $this->getEntityManager()
                ->flush();
        }
    }

    public function getLastCreatedUser(): ?User
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
