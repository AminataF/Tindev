<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
class Competence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user_browse', 'user_read', 'latest_users', 'browse_competence', 'competence_read', 'add_competence', 'user_profile'])]
    private ?int $id = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Groups(['user_browse', 'user_read', 'latest_users', 'browse_competence', 'competence_read', 'add_competence', 'user_profile'])]
    private ?string $techno = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'competences')]
    #[Groups(['browse_competence', 'competence_read', 'add_competence'])]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'category')]
    #[Groups(['user_browse', 'user_read', 'latest_users', 'browse_competence', 'competence_read', 'add_competence', 'user_profile'])]
    private ?Category $category = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTechno(): ?string
    {
        return $this->techno;
    }

    public function setTechno(?string $techno): static
    {
        $this->techno = $techno;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addCompetence($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeCompetence($this);
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
