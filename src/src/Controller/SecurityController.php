<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Utilisateur;
use App\Enum\UserRole;

final class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if (($user = $this->getUser()) instanceof Utilisateur) {
            return $this->redirectToRoute(match ($user->getRoleMetier()) {
                UserRole::ADMIN, UserRole::EMPLOYEE => 'app_admin',
                UserRole::HOTEL => 'app_planning_hotel',
                UserRole::CLIENT => 'app_compte',
            });
        }
        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route('/deconnexion', name: 'app_logout')]
    public function logout(): never { throw new \LogicException('Intercepté par le pare-feu Symfony.'); }
}
