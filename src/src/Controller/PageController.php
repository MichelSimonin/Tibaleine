<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response { return $this->render('page/home.html.twig'); }

    #[Route('/informations', name: 'app_informations')]
    public function informations(): Response { return $this->render('page/informations.html.twig'); }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response { return $this->render('page/contact.html.twig'); }
}
