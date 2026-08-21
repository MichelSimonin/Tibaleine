<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\TypeDocument;
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

    /** @var Collection<int, Reservation> */
    #[ORM\OneToMany(mappedBy: 'document', targetEntity: Reservation::class)]
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
    /** @return Collection<int, Reservation> */
    public function getReservations(): Collection { return $this->reservations; }
}
