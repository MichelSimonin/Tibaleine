<?php
declare(strict_types=1);
namespace App\Entity;

final class Notification
{
    public function __construct(private string $type, private ?Reservation $reservation = null, private ?\DateTimeImmutable $dateEnvoi = null, private ?string $langue = null, private string $contenu = '', private ?string $canal = null, private ?string $destinataire = null) {}
    public function getType(): string { return $this->type; }
    public function getReservation(): ?Reservation { return $this->reservation; }
    public function getDateEnvoi(): ?\DateTimeImmutable { return $this->dateEnvoi; }
    public function getLangue(): ?string { return $this->langue; }
    public function getContenu(): string { return $this->contenu; }
    public function getCanal(): ?string { return $this->canal; }
    public function getDestinataire(): ?string { return $this->destinataire; }
}