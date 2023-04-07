<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'delegations',)]
class Delegation
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string')]
    private string $country;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $startDelegation;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $endDelegation;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'delegations')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User $user;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getStartDelegation(): ?\DateTimeInterface
    {
        return $this->startDelegation;
    }

    public function setStartDelegation(\DateTimeInterface $startDelegation): self
    {
        $this->startDelegation = $startDelegation;

        return $this;
    }

    public function getEndDelegation(): ?\DateTimeInterface
    {
        return $this->endDelegation;
    }

    public function setEndDelegation(\DateTimeInterface $endDelegation): self
    {
        $this->endDelegation = $endDelegation;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
