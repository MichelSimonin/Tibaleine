<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\EtatSortie;
use App\Enum\TypeSortie;
use App\Repository\SortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
#[ORM\Index(name: 'idx_sortie_date', columns: ['date'])]
#[ORM\UniqueConstraint(name: 'uniq_sortie_creneau_bateau', columns: ['date', 'heure_depart', 'bateau_id'])]
class Sortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: TypeSortie::class)]
    private TypeSortie $type;

    #[ORM\Column(type: 'date_immutable')]
    private \DateTimeImmutable $date;

    #[ORM\Column(type: 'time_immutable')]
    private \DateTimeImmutable $heureDepart;

    #[ORM\Column(type: 'time_immutable')]
    private \DateTimeImmutable $duree;

    #[ORM\ManyToOne(inversedBy: 'sorties')]
    #[ORM\JoinColumn(nullable: false)]
    private Bateau $bateau;

    #[ORM\Column(enumType: EtatSortie::class)]
    private EtatSortie $etat = EtatSortie::PLANIFIEE;

    #[ORM\Column]
    private bool $nouvellePlaceDisponible = false;

    /** @var Collection<int, Reservation> */
    #[ORM\OneToMany(mappedBy: 'sortie', targetEntity: Reservation::class)]
    private Collection $reservations;

    /** @var Collection<int, BlocagePlace> */
    #[ORM\OneToMany(mappedBy: 'sortie', targetEntity: BlocagePlace::class, orphanRemoval: true)]
    private Collection $blocages;

    public function __construct()
    {
        $this->date = new \DateTimeImmutable('today');
        $this->heureDepart = new \DateTimeImmutable('07:00');
        $this->duree = new \DateTimeImmutable('02:00');
        $this->reservations = new ArrayCollection();
        $this->blocages = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getType(): TypeSortie { return $this->type; }
    public function setType(TypeSortie $type): self { $this->type = $type; return $this; }
    public function getDate(): \DateTimeImmutable { return $this->date; }
    public function setDate(\DateTimeImmutable $date): self { $this->date = $date; return $this; }
    public function getHeureDepart(): \DateTimeImmutable { return $this->heureDepart; }
    public function setHeureDepart(\DateTimeImmutable $heure): self { $this->heureDepart = $heure; return $this; }
    public function getDuree(): \DateTimeImmutable { return $this->duree; }
    public function setDuree(\DateTimeImmutable $duree): self { $this->duree = $duree; return $this; }
    public function getBateau(): Bateau { return $this->bateau; }
    public function setBateau(Bateau $bateau): self { $this->bateau = $bateau; $bateau->addSortie($this); return $this; }
    public function getEtat(): EtatSortie { return $this->etat; }
    public function setEtat(EtatSortie $etat): self { $this->etat = $etat; return $this; }
    public function hasNouvellePlaceDisponible(): bool { return $this->nouvellePlaceDisponible; }
    public function setNouvellePlaceDisponible(bool $disponible): self { $this->nouvellePlaceDisponible = $disponible; return $this; }
    /** @return Collection<int, Reservation> */
    public function getReservations(): Collection { return $this->reservations; }
    public function addReservation(Reservation $reservation): self { if (!$this->reservations->contains($reservation)) { $this->reservations->add($reservation); } return $this; }
    public function removeReservation(Reservation $reservation): self { $this->reservations->removeElement($reservation); return $this; }
    /** @return Collection<int, BlocagePlace> */
    public function getBlocages(): Collection { return $this->blocages; }

    public function getDepart(): \DateTimeImmutable
    {
        return $this->date->setTime(
            (int) $this->heureDepart->format('H'),
            (int) $this->heureDepart->format('i'),
        );
    }
}
