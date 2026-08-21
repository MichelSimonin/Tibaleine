<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\BateauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BateauRepository::class)]
#[ORM\UniqueConstraint(name: 'uniq_bateau_nom', columns: ['nom'])]
class Bateau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private string $nom;

    #[ORM\Column]
    private int $capacite;

    /** @var Collection<int, Sortie> */
    #[ORM\OneToMany(mappedBy: 'bateau', targetEntity: Sortie::class)]
    private Collection $sorties;

    public function __construct(string $nom = '', int $capacite = 0)
    {
        $this->nom = $nom;
        $this->capacite = $capacite;
        $this->sorties = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }
    public function getCapacite(): int { return $this->capacite; }
    public function setCapacite(int $capacite): self { $this->capacite = $capacite; return $this; }
    /** @return Collection<int, Sortie> */
    public function getSorties(): Collection { return $this->sorties; }
}
