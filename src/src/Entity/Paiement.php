<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\CanalPaiement;
use App\Enum\StatutOperation;
use App\Enum\TypePaiement;
use App\Repository\PaiementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: TypePaiement::class)]
    private TypePaiement $type;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $montant;

    #[ORM\Column(enumType: CanalPaiement::class)]
    private CanalPaiement $canal;

    #[ORM\Column(enumType: StatutOperation::class)]
    private StatutOperation $statut = StatutOperation::EN_ATTENTE;

    #[ORM\Column(length: 120, unique: true, nullable: true)]
    private ?string $referenceExterne = null;

    #[ORM\Column]
    private \DateTimeImmutable $dateInitiation;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $dateConfirmation = null;

    #[ORM\ManyToOne(inversedBy: 'paiements')]
    #[ORM\JoinColumn(nullable: false)]
    private Reservation $reservation;

    public function __construct()
    {
        $this->dateInitiation = new \DateTimeImmutable();
    }

    public function getId(): ?int { return $this->id; }
    public function getType(): TypePaiement { return $this->type; }
    public function setType(TypePaiement $type): self { $this->type = $type; return $this; }
    public function getMontant(): string { return $this->montant; }
    public function setMontant(string $montant): self { $this->montant = $montant; return $this; }
    public function getCanal(): CanalPaiement { return $this->canal; }
    public function setCanal(CanalPaiement $canal): self { $this->canal = $canal; return $this; }
    public function getStatut(): StatutOperation { return $this->statut; }
    public function setStatut(StatutOperation $statut): self { $this->statut = $statut; return $this; }
    public function getReferenceExterne(): ?string { return $this->referenceExterne; }
    public function setReferenceExterne(?string $reference): self { $this->referenceExterne = $reference; return $this; }
    public function getDateInitiation(): \DateTimeImmutable { return $this->dateInitiation; }
    public function getDateConfirmation(): ?\DateTimeImmutable { return $this->dateConfirmation; }
    public function confirmer(): self { $this->statut = StatutOperation::PAYE; $this->dateConfirmation = new \DateTimeImmutable(); return $this; }
    public function getReservation(): Reservation { return $this->reservation; }
    public function setReservation(Reservation $reservation): self { $this->reservation = $reservation; return $this; }
}
