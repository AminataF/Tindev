<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['browse_projects','project_read', 'user_read', 'user_profile'])]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(['browse_projects','project_read', 'add_project', 'user_read', 'user_profile'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['browse_projects','project_read', 'add_project', 'user_read', 'user_profile'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['browse_projects','project_read', 'add_project', 'user_read', 'user_profile'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['browse_projects','project_read', 'add_project', 'user_read', 'user_profile'])]
    private ?string $techno = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['browse_projects','project_read', 'add_project', 'user_read', 'user_profile'])]
    private ?string $github = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['browse_projects','project_read', 'add_project', 'user_read', 'user_profile'])]
    private ?string $urlProject = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['browse_projects','project_read', 'add_project', 'user_read', 'user_profile'])]
    private ?string $upload = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updateAt = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
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

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): static
    {
        $this->github = $github;

        return $this;
    }

    public function getUrlProject(): ?string
    {
        return $this->urlProject;
    }

    public function setUrlProject(?string $urlProject): static
    {
        $this->urlProject = $urlProject;

        return $this;
    }

    public function getUpload(): ?string
    {
        return $this->upload;
    }

    public function setUplad(?string $upload): static
    {
        $this->upload = $upload;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
