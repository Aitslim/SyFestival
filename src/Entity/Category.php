<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nameCategory;

    /**
     * @ORM\ManyToMany(targetEntity=Artiste::class, mappedBy="category")
     */
    private $artistes;

    public function __construct()
    {
        $this->artistes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->nameCategory;
    }

    public function setNameCategory(string $nameCategory): self
    {
        $this->nameCategory = $nameCategory;

        return $this;
    }

    /**
     * @return Collection|Artiste[]
     */
    public function getArtistes(): Collection
    {
        return $this->artistes;
    }

    public function addArtiste(Artiste $artiste): self
    {
        if (!$this->artistes->contains($artiste)) {
            $this->artistes[] = $artiste;
            $artiste->addCategory($this);
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): self
    {
        if ($this->artistes->removeElement($artiste)) {
            $artiste->removeCategory($this);
        }

        return $this;
    }
}
