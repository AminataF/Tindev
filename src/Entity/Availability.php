<?php

namespace App\Entity;

use App\Repository\AvailabilityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvailabilityRepository::class)]
class Availability
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['browse_availability', 'user_browse', 'user_read', 'latest_users', 'user_profile'])]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(['browse_availability', 'user_browse', 'user_read', 'latest_users', 'user_profile'])]
    private ?string $availability = null;

    // #[ORM\OneToMany(mappedBy: 'availability', targetEntity: User::class)]
    // private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvailability(): ?string
    {
        return $this->availability;
    }

    public function setAvailability(?string $availability): static
    {
        $this->availability = $availability;

        return $this;
    }

    // /**
    //  * @return Collection<int, User>
    //  */
    // public function getUsers(): Collection
    // {
    //     return $this->users;
    // }

    // public function addUser(User $user): static
    // {
    //     if (!$this->users->contains($user)) {
    //         $this->users->add($user);
    //         $user->setAvailability($this);
    //     }

    //     return $this;
    // }

    // public function removeUser(User $user): static
    // {
    //     if ($this->users->removeElement($user)) {
    //         // set the owning side to null (unless already changed)
    //         if ($user->getAvailability() === $this) {
    //             $user->setAvailability(null);
    //         }
    //     }

    //     return $this;
    // }
}
