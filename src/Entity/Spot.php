<?php

namespace App\Entity;

use App\Repository\SpotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpotRepository::class)]
class Spot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private ?string $position = null;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private ?string $access = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private ?string $orientation = null;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private ?string $water = null;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private ?string $dangers = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $more = null;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private ?string $security = null;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private ?string $subtitle = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $windguruId;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getAccess(): ?string
    {
        return $this->access;
    }

    public function setAccess(?string $access): self
    {
        $this->access = $access;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOrientation(): ?string
    {
        return $this->orientation;
    }

    public function setOrientation(string $orientation): self
    {
        $this->orientation = $orientation;

        return $this;
    }

    public function getWater(): ?string
    {
        return $this->water;
    }

    public function setWater(?string $water): self
    {
        $this->water = $water;

        return $this;
    }

    public function getDangers(): ?string
    {
        return $this->dangers;
    }

    public function setDangers(?string $dangers): self
    {
        $this->dangers = $dangers;

        return $this;
    }

    public function getMore(): ?string
    {
        return $this->more;
    }

    public function setMore(?string $more): self
    {
        $this->more = $more;

        return $this;
    }

    public function getSecurity(): ?string
    {
        return $this->security;
    }

    public function setSecurity(?string $security): self
    {
        $this->security = $security;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPictureUrl(): ?string
    {
        if (!$this->picture) {
            return null;
        }
        if (str_contains($this->picture, '/')) {
            return $this->picture;
        }

        return sprintf('/uploads/%s', $this->picture);
    }

    public function getWindguruId(): ?int
    {
        return $this->windguruId;
    }

    public function setWindguruId(?int $windguruId): self
    {
        $this->windguruId = $windguruId;

        return $this;
    }
}
