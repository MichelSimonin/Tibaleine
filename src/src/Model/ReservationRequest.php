<?php

declare(strict_types=1);

namespace App\Model;

use App\Enum\Langue;
use Symfony\Component\Validator\Constraints as Assert;

final class ReservationRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $prenom = '';

    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $nom = '';

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email = '';

    #[Assert\NotBlank]
    #[Assert\Length(min: 8, max: 30)]
    public string $telephone = '';

    #[Assert\PositiveOrZero]
    public int $nbAdultes = 2;

    #[Assert\PositiveOrZero]
    public int $nbEnfants = 0;

    #[Assert\Length(min: 8, max: 72)]
    #[Assert\Regex(pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).+$/', message: 'Le mot de passe doit contenir une minuscule, une majuscule, un chiffre et un caractère spécial.')]
    public ?string $motDePasse = null;

    public Langue $langue = Langue::FR;

    #[Assert\NotBlank]
    public string $blocageToken = '';

    #[Assert\IsTrue(message: 'Une réservation doit concerner au minimum deux personnes.')]
    public function isMinimumDeuxPersonnes(): bool
    {
        return $this->nbAdultes + $this->nbEnfants >= 2;
    }
}
