<?php

namespace App\Entity;

use App\Repository\YearExperienceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: YearExperienceRepository::class)]
class YearExperience
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['browse_yearExperience','user_browse', 'user_read', 'user_profile'])]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(['browse_yearExperience','user_browse', 'user_read', 'user_profile'])]
    private ?string $yearExp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYearExp(): ?string
    {
        return $this->yearExp;
    }

    public function setYearExp(?string $yearExp): static
    {
        $this->yearExp = $yearExp;

        return $this;
    }
}
