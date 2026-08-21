<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\Utilisateur;
use App\Enum\UserRole;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

final class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    public function __construct(private readonly UrlGeneratorInterface $urls) {}
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): ?Response
    {
        $user = $token->getUser();
        $route = $user instanceof Utilisateur ? match ($user->getRoleMetier()) {
            UserRole::ADMIN, UserRole::EMPLOYEE => 'app_admin',
            UserRole::HOTEL => 'app_planning_hotel',
            UserRole::CLIENT => 'app_compte',
        } : 'app_home';
        return new RedirectResponse($this->urls->generate($route));
    }
}
