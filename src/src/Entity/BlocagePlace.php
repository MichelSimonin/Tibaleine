<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\PhaseBlocage;
use App\Repository\BlocagePlaceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlocagePlaceRepository::class)]
#[ORM\Index(name: 'idx_blocage_expiration', columns: ['expire_le'])]
class BlocagePlace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64, unique: true)]
    private string $jeton;

    #[ORM\Column]
    private int $nombrePlaces;

    #[ORM\Column(enumType: PhaseBlocage::class)]
    private PhaseBlocage $phase = PhaseBlocage::FORMULAIRE;

    #[ORM\Column]
    private \DateTimeImmutable $creeLe;

    #[ORM\Column]
    private \DateTimeImmutable $expireLe;

    #[ORM\ManyToOne(inversedBy: 'blocages')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Sortie $sortie;

    public function __construct()
    {
        $this->jeton = bin2hex(random_bytes(24));
        $this->creeLe = new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        $this->expireLe = $this->creeLe->modify('+15 minutes');
        $this->nombrePlaces = 2;
    }

    public function getId(): ?int { return $this->id; }
    public function getJeton(): string { return $this->jeton; }
    public function getNombrePlaces(): int { return $this->nombrePlaces; }
    public function setNombrePlaces(int $nombre): self { $this->nombrePlaces = $nombre; return $this; }
    public function getPhase(): PhaseBlocage { return $this->phase; }
    public function setPhase(PhaseBlocage $phase): self { $this->phase = $phase; return $this; }
    public function getCreeLe(): \DateTimeImmutable { return $this->creeLe; }
    public function getExpireLe(): \DateTimeImmutable { return $this->expireLe; }
    public function setExpireLe(\DateTimeImmutable $date): self { $this->expireLe = $date; return $this; }
    public function getSortie(): Sortie { return $this->sortie; }
    public function setSortie(Sortie $sortie): self { $this->sortie = $sortie; return $this; }
    public function estExpire(?\DateTimeImmutable $maintenant = null): bool
    {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        return $this->expireLe <= $maintenant;
    }
}
