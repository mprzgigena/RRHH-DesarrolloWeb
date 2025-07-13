<?php

namespace App\Entity;

use App\Repository\PeliculaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeliculaRepository::class)]
class Pelicula
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pelicula = null;

    #[ORM\Column]
    private ?int $añoEstreno = null;

    #[ORM\ManyToOne(inversedBy: 'peliculas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Director $director = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPelicula(): ?string
    {
        return $this->pelicula;
    }

    public function setPelicula(string $pelicula): static
    {
        $this->pelicula = $pelicula;

        return $this;
    }

    public function getAñoEstreno(): ?int
    {
        return $this->añoEstreno;
    }

    public function setAñoEstreno(int $añoEstreno): static
    {
        $this->añoEstreno = $añoEstreno;

        return $this;
    }

    public function getDirector(): ?Director
    {
        return $this->director;
    }

    public function setDirector(?Director $director): static
    {
        $this->director = $director;

        return $this;
    }
}
