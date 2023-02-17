<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TimeoController extends AbstractController
{

    #[Route('/tournois', name: 'app_tournois')]
    public function tournois(): Response
    {
        return $this->render('timeo/tournois.html.twig', [
            'controller_name' => 'TimeoController',
        ]);
    }

    #[Route('/timeo', name: 'app_timeo')]
    public function index(): Response
    {
        return $this->render('timeo/index.html.twig', [
            'controller_name' => 'TimeoController',
        ]);
    }

    #[Route('/timeo/hogwart', name: 'app_timeo_hogwart')]
    public function hogwart(): Response
    {
        return $this->render('timeo/hogwart.html.twig', [
            'controller_name' => 'TimeoController',
        ]);
    }

    #[Route('/timeo/rocket', name: 'app_timeo_rocket')]
    public function rocket(): Response
    {
        return $this->render('timeo/rocket.html.twig', [
            'controller_name' => 'TimeoController',
        ]);
    }

    #[Route('/timeo/apex', name: 'app_timeo_apex')]
    public function apex(): Response
    {
        return $this->render('timeo/apex.html.twig', [
            'controller_name' => 'TimeoController',
        ]);
    }

    #[Route('/timeo/fifa23', name: 'app_timeo_fifa23')]
    public function fifa23(): Response
    {
        return $this->render('timeo/fifa23.html.twig', [
            'controller_name' => 'TimeoController',
        ]);
    }
}
