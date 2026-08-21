<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\EtatReservation;
use App\Enum\StatutPaiement;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ORM\Index(name: 'idx_reservation_etat', columns: ['etat'])]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: EtatReservation::class)]
    private EtatReservation $etat = EtatReservation::RESERVEE;

    #[ORM\Column(enumType: StatutPaiement::class)]
    private StatutPaiement $statutPaiement = StatutPaiement::EN_ATTENTE;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $motifAnnulation = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $montantInitial = '0.00';

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $montantCourant = '0.00';

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $acompte = '0.00';

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $solde = '0.00';

    #[ORM\Column]
    private int $nbAdultes = 0;

    #[ORM\Column]
    private int $nbEnfants = 0;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private Utilisateur $utilisateur;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private Sortie $sortie;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Document $document = null;

    /** @var Collection<int, Paiement> */
    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: Paiement::class, cascade: ['persist'])]
    #[ORM\OrderBy(['dateInitiation' => 'DESC'])]
    private Collection $paiements;

    public function __construct()
    {
        $this->paiements = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getEtat(): EtatReservation { return $this->etat; }
    public function setEtat(EtatReservation $etat): self { $this->etat = $etat; return $this; }
    public function getStatutPaiement(): StatutPaiement { return $this->statutPaiement; }
    public function setStatutPaiement(StatutPaiement $statut): self { $this->statutPaiement = $statut; return $this; }
    public function getMotifAnnulation(): ?string { return $this->motifAnnulation; }
    public function setMotifAnnulation(?string $motif): self { $this->motifAnnulation = $motif; return $this; }
    public function getMontantInitial(): string { return $this->montantInitial; }
    public function setMontantInitial(string $montant): self { $this->montantInitial = $montant; return $this; }
    public function getMontantCourant(): string { return $this->montantCourant; }
    public function setMontantCourant(string $montant): self { $this->montantCourant = $montant; return $this; }
    public function getAcompte(): string { return $this->acompte; }
    public function setAcompte(string $acompte): self { $this->acompte = $acompte; return $this; }
    public function getSolde(): string { return $this->solde; }
    public function setSolde(string $solde): self { $this->solde = $solde; return $this; }
    public function getNbAdultes(): int { return $this->nbAdultes; }
    public function setNbAdultes(int $nombre): self { $this->nbAdultes = $nombre; return $this; }
    public function getNbEnfants(): int { return $this->nbEnfants; }
    public function setNbEnfants(int $nombre): self { $this->nbEnfants = $nombre; return $this; }
    public function getNombreParticipants(): int { return $this->nbAdultes + $this->nbEnfants; }
    public function getUtilisateur(): Utilisateur { return $this->utilisateur; }
    public function setUtilisateur(Utilisateur $utilisateur): self { $this->utilisateur = $utilisateur; return $this; }
    public function getSortie(): Sortie { return $this->sortie; }
    public function setSortie(Sortie $sortie): self { $this->sortie = $sortie; return $this; }
    public function getDocument(): ?Document { return $this->document; }
    public function setDocument(?Document $document): self { $this->document = $document; return $this; }
    /** @return Collection<int, Paiement> */
    public function getPaiements(): Collection { return $this->paiements; }
    public function addPaiement(Paiement $paiement): self { if (!$this->paiements->contains($paiement)) { $this->paiements->add($paiement); $paiement->setReservation($this); } return $this; }
}
