<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\CanalNotification;
use App\Enum\TypeNotification;
use App\Enum\StatutNotification;
use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: TypeNotification::class)]
    private TypeNotification $type;

    #[ORM\Column(enumType: CanalNotification::class)]
    private CanalNotification $canal;

    #[ORM\Column]
    private \DateTimeImmutable $dateEnvoi;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $contenu = null;

    #[ORM\Column(enumType: StatutNotification::class)]
    private StatutNotification $statut = StatutNotification::EN_ATTENTE;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $erreur = null;

    #[ORM\ManyToOne]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne]
    private ?Reservation $reservation = null;

    #[ORM\ManyToOne]
    private ?Sortie $sortie = null;

    public function __construct() { $this->dateEnvoi = new \DateTimeImmutable(); }
    public function getId(): ?int { return $this->id; }
    public function getType(): TypeNotification { return $this->type; }
    public function setType(TypeNotification $type): self { $this->type = $type; return $this; }
    public function getCanal(): CanalNotification { return $this->canal; }
    public function setCanal(CanalNotification $canal): self { $this->canal = $canal; return $this; }
    public function getDateEnvoi(): \DateTimeImmutable { return $this->dateEnvoi; }
    public function setDateEnvoi(\DateTimeImmutable $date): self { $this->dateEnvoi = $date; return $this; }
    public function getContenu(): ?string { return $this->contenu; }
    public function setContenu(?string $contenu): self { $this->contenu = $contenu; return $this; }
    public function getStatut(): StatutNotification { return $this->statut; }
    public function marquerEnvoyee(): self { $this->statut = StatutNotification::ENVOYEE; $this->erreur = null; return $this; }
    public function marquerEchec(string $erreur): self { $this->statut = StatutNotification::ECHEC; $this->erreur = $erreur; return $this; }
    public function getErreur(): ?string { return $this->erreur; }
    public function getUtilisateur(): ?Utilisateur { return $this->utilisateur; }
    public function setUtilisateur(?Utilisateur $utilisateur): self { $this->utilisateur = $utilisateur; return $this; }
    public function getReservation(): ?Reservation { return $this->reservation; }
    public function setReservation(?Reservation $reservation): self { $this->reservation = $reservation; return $this; }
    public function getSortie(): ?Sortie { return $this->sortie; }
    public function setSortie(?Sortie $sortie): self { $this->sortie = $sortie; return $this; }
}
