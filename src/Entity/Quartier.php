<?php

namespace App\Entity;

use App\Repository\QuartierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuartierRepository::class)]
class Quartier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'quartier', targetEntity: Pharmacie::class)]
    private Collection $pharmacies;

    #[ORM\OneToMany(mappedBy: 'quartier', targetEntity: Dispensaire::class)]
    private Collection $dispensaires;

    public function __construct()
    {
        $this->pharmacies = new ArrayCollection();
        $this->dispensaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Pharmacie>
     */
    public function getPharmacies(): Collection
    {
        return $this->pharmacies;
    }

    public function addPharmacy(Pharmacie $pharmacy): self
    {
        if (!$this->pharmacies->contains($pharmacy)) {
            $this->pharmacies->add($pharmacy);
            $pharmacy->setQuartier($this);
        }

        return $this;
    }

    public function removePharmacy(Pharmacie $pharmacy): self
    {
        if ($this->pharmacies->removeElement($pharmacy)) {
            // set the owning side to null (unless already changed)
            if ($pharmacy->getQuartier() === $this) {
                $pharmacy->setQuartier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dispensaire>
     */
    public function getDispensaires(): Collection
    {
        return $this->dispensaires;
    }

    public function addDispensaire(Dispensaire $dispensaire): self
    {
        if (!$this->dispensaires->contains($dispensaire)) {
            $this->dispensaires->add($dispensaire);
            $dispensaire->setQuartier($this);
        }

        return $this;
    }

    public function removeDispensaire(Dispensaire $dispensaire): self
    {
        if ($this->dispensaires->removeElement($dispensaire)) {
            // set the owning side to null (unless already changed)
            if ($dispensaire->getQuartier() === $this) {
                $dispensaire->setQuartier(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }
}
