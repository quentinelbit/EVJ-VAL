<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/timeo', name: 'app_timeo')]
    public function timeo(): Response
    {
        return $this->render('home/timeo.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/timeo/hogwart', name: 'app_timeo_hogwart')]
    public function timeo_hogwart(): Response
    {
        return $this->render('home/timeo_hogwart.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/timeo/rocket', name: 'app_timeo_rocket')]
    public function timeo_rocket(): Response
    {
        return $this->render('home/timeo_rocket.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


}
