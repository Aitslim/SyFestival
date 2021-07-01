<?php

namespace App\Entity;

use App\Repository\ConcertRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConcertRepository::class)
 */
class Concert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateconcert;

    /**
     * @ORM\Column(type="time")
     */
    private $heuredebut;

    /**
     * @ORM\Column(type="time")
     */
    private $heurefin;

    /**
     * @ORM\OneToOne(targetEntity=Artist::class, cascade={"persist", "remove"})
     */
    private $artist;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateconcert(): ?\DateTimeInterface
    {
        return $this->dateconcert;
    }

    public function setDateconcert(\DateTimeInterface $dateconcert): self
    {
        $this->dateconcert = $dateconcert;

        return $this;
    }

    public function getHeuredebut(): ?\DateTimeInterface
    {
        return $this->heuredebut;
    }

    public function setHeuredebut(\DateTimeInterface $heuredebut): self
    {
        $this->heuredebut = $heuredebut;

        return $this;
    }

    public function getHeurefin(): ?\DateTimeInterface
    {
        return $this->heurefin;
    }

    public function setHeurefin(\DateTimeInterface $heurefin): self
    {
        $this->heurefin = $heurefin;

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }
}
