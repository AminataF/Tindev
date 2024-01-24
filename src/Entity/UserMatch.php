<?php

namespace App\Entity;

use App\Repository\UserMatchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Table(name: "userMatch")]
#[ORM\Entity(repositoryClass: UserMatchRepository::class)]
class UserMatch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    // #[Groups(['user_match_read'])]
    private ?int $id = null;

    #[ORM\Column(length: 15, nullable: true)]
    // #[Groups(['user_match_read'])]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'matchesGiven')]
    // #[Groups(['user_match_read'])]
    private ?User $userMatcher = null;

    #[ORM\ManyToOne(inversedBy: 'matchesReceived')]
    // #[Groups(['user_match_read'])]
    private ?User $userMatched = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUserMatcher(): ?User
    {
        return $this->userMatcher;
    }

    public function setUserMatcher(?User $userMatcher): static
    {
        $this->userMatcher = $userMatcher;

        return $this;
    }

    public function getUserMatched(): ?User
    {
        return $this->userMatched;
    }

    public function setUserMatched(?User $userMatched): static
    {
        $this->userMatched = $userMatched;

        return $this;
    }
}
