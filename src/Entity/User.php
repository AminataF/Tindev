<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 35, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 35, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 120, nullable: true)]
    private ?string $town = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $cv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $github = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $linkedin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $portfolio = null;

    #[ORM\Column(length: 35, nullable: true)]
    private ?string $profilePicture = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $pricing = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $CreatedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updateAt = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Project::class)]
    private Collection $projects;

    #[ORM\ManyToMany(targetEntity: Competence::class, inversedBy: 'users')]
    private Collection $competences;

    #[ORM\ManyToOne]
    private ?Job $job = null;

    #[ORM\ManyToOne]
    private ?YearExperience $yearExp = null;

    #[ORM\ManyToOne]
    private ?Availability $availability = null;

    #[ORM\ManyToMany(targetEntity: UserMatch::class, mappedBy: 'userMatcher')]
    private Collection $matchesGiven;

    #[ORM\ManyToMany(targetEntity: UserMatch::class, mappedBy: 'userMatched')]
    private Collection $matchesReceived;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->competences = new ArrayCollection();
        $this->matchesGiven = new ArrayCollection();
        $this->matchesReceived = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(?string $town): static
    {
        $this->town = $town;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): static
    {
        $this->github = $github;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): static
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getPortfolio(): ?string
    {
        return $this->portfolio;
    }

    public function setPortfolio(?string $portfolio): static
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): static
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPricing(): ?int
    {
        return $this->pricing;
    }

    public function setPricing(?int $pricing): static
    {
        $this->pricing = $pricing;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(?\DateTimeInterface $CreatedAt): static
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeInterface $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->setUser($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getUser() === $this) {
                $project->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Competence>
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): static
    {
        if (!$this->competences->contains($competence)) {
            $this->competences->add($competence);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): static
    {
        $this->competences->removeElement($competence);

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): static
    {
        $this->job = $job;

        return $this;
    }

    public function getYearExp(): ?YearExperience
    {
        return $this->yearExp;
    }

    public function setYearExp(?YearExperience $yearExp): static
    {
        $this->yearExp = $yearExp;

        return $this;
    }

    public function getAvailability(): ?Availability
    {
        return $this->availability;
    }

    public function setAvailability(?Availability $availability): static
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * @return Collection<int, UserMatch>
     */
    public function getMatchesGiven(): Collection
    {
        return $this->matchesGiven;
    }

    public function addMatchesGiven(UserMatch $matchesGiven): static
    {
        if (!$this->matchesGiven->contains($matchesGiven)) {
            $this->matchesGiven->add($matchesGiven);
            $matchesGiven->addUserMatcher($this);
        }

        return $this;
    }

    public function removeMatchesGiven(UserMatch $matchesGiven): static
    {
        if ($this->matchesGiven->removeElement($matchesGiven)) {
            $matchesGiven->removeUserMatcher($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, UserMatch>
     */
    public function getMatchesReceived(): Collection
    {
        return $this->matchesReceived;
    }

    public function addMatchesReceived(UserMatch $matchesReceived): static
    {
        if (!$this->matchesReceived->contains($matchesReceived)) {
            $this->matchesReceived->add($matchesReceived);
            $matchesReceived->addUserMatched($this);
        }

        return $this;
    }

    public function removeMatchesReceived(UserMatch $matchesReceived): static
    {
        if ($this->matchesReceived->removeElement($matchesReceived)) {
            $matchesReceived->removeUserMatched($this);
        }

        return $this;
    }

}
