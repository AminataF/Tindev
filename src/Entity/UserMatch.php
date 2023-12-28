<?php

namespace App\Entity;

use App\Repository\UserMatchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserMatchRepository::class)]
class UserMatch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'matchesGiven')]
    private Collection $userMatcher;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'matchesReceived')]
    private Collection $userMatched;

    public function __construct()
    {
        $this->userMatcher = new ArrayCollection();
        $this->userMatched = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, User>
     */
    public function getUserMatcher(): Collection
    {
        return $this->userMatcher;
    }

    public function addUserMatcher(User $userMatcher): static
    {
        if (!$this->userMatcher->contains($userMatcher)) {
            $this->userMatcher->add($userMatcher);
        }

        return $this;
    }

    public function removeUserMatcher(User $userMatcher): static
    {
        $this->userMatcher->removeElement($userMatcher);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserMatched(): Collection
    {
        return $this->userMatched;
    }

    public function addUserMatched(User $userMatched): static
    {
        if (!$this->userMatched->contains($userMatched)) {
            $this->userMatched->add($userMatched);
        }

        return $this;
    }

    public function removeUserMatched(User $userMatched): static
    {
        $this->userMatched->removeElement($userMatched);

        return $this;
    }
}
