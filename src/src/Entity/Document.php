<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\TypeDocument;
use App\Enum\StatutPaiement;
use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: TypeDocument::class)]
    private TypeDocument $type;

    #[ORM\Column(length: 80, unique: true)]
    private string $reference;

    #[ORM\Column]
    private \DateTimeImmutable $dateEmission;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?string $montant = null;

    /** @var Collection<int, Reservation> */
    #[ORM\ManyToMany(targetEntity: Reservation::class, mappedBy: 'documents')]
    private Collection $reservations;

    public function __construct()
    {
        $this->dateEmission = new \DateTimeImmutable();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getType(): TypeDocument { return $this->type; }
    public function setType(TypeDocument $type): self { $this->type = $type; return $this; }
    public function getReference(): string { return $this->reference; }
    public function setReference(string $reference): self { $this->reference = $reference; return $this; }
    public function getDateEmission(): \DateTimeImmutable { return $this->dateEmission; }
    public function getMontant(): ?string { return $this->montant; }
    public function setMontant(?string $montant): self { $this->montant = $montant; return $this; }
    /** @return Collection<int, Reservation> */
    public function getReservations(): Collection { return $this->reservations; }
    public function addReservation(Reservation $reservation): self { if (!$this->reservations->contains($reservation)) { $this->reservations->add($reservation); } return $this; }
    public function estRegle(): bool
    {
        return !$this->reservations->isEmpty()
            && $this->reservations->forAll(static fn (int $index, Reservation $reservation): bool => $reservation->getStatutPaiement() === StatutPaiement::INTEGRALEMENT_PAYE);
    }
}
