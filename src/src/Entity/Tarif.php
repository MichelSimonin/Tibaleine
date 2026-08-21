<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\TypeSortie;
use App\Repository\TarifRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarifRepository::class)]
class Tarif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: TypeSortie::class)]
    private TypeSortie $typeSortie;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $categorie = null;

    #[ORM\ManyToOne]
    private ?Bateau $bateau = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $montant;

    public function getId(): ?int { return $this->id; }
    public function getTypeSortie(): TypeSortie { return $this->typeSortie; }
    public function setTypeSortie(TypeSortie $type): self { $this->typeSortie = $type; return $this; }
    public function getCategorie(): ?string { return $this->categorie; }
    public function setCategorie(?string $categorie): self { $this->categorie = $categorie; return $this; }
    public function getBateau(): ?Bateau { return $this->bateau; }
    public function setBateau(?Bateau $bateau): self { $this->bateau = $bateau; return $this; }
    public function getMontant(): string { return $this->montant; }
    public function setMontant(string $montant): self { $this->montant = $montant; return $this; }
}
