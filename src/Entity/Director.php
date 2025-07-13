<?php

namespace App\Entity;

use App\Repository\DirectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DirectorRepository::class)]
class Director
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreDirector = null;

    /**
     * @var Collection<int, Pelicula>
     */
    #[ORM\OneToMany(targetEntity: Pelicula::class, mappedBy: 'director')]
    private Collection $peliculas;

    public function __construct()
    {
        $this->peliculas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreDirector(): ?string
    {
        return $this->nombreDirector;
    }

    public function setNombreDirector(string $nombreDirector): static
    {
        $this->nombreDirector = $nombreDirector;

        return $this;
    }

    /**
     * @return Collection<int, Pelicula>
     */
    public function getPeliculas(): Collection
    {
        return $this->peliculas;
    }

    public function addPelicula(Pelicula $pelicula): static
    {
        if (!$this->peliculas->contains($pelicula)) {
            $this->peliculas->add($pelicula);
            $pelicula->setDirector($this);
        }

        return $this;
    }

    public function removePelicula(Pelicula $pelicula): static
    {
        if ($this->peliculas->removeElement($pelicula)) {
            // set the owning side to null (unless already changed)
            if ($pelicula->getDirector() === $this) {
                $pelicula->setDirector(null);
            }
        }

        return $this;
    }
}
