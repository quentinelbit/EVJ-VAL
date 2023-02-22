<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $user = $this->getUser();
        $view = 'home/notFound.html.twig';


        if ($user->getNbTry() <= 0) {
            $view = 'home/noMoreTentatives.html.twig';
            return $this->render('home/noMoreTentatives.html.twig', [
                'controller_name' => 'HomeController',
            ]);
        }


        switch ($user->getProgress()){
            case 0:
                $view = 'home/index.html.twig';
                break;
            case 1:
                $view = 'home/arthur.html.twig';
                break;
            case 2:
                $view = 'home/antoine.html.twig';
                break;
            case 3:
                $view = 'home/alexandre.html.twig';
                break;
            case 4:
                $view = 'home/marwane.html.twig';
                break;
            case 5:
                $view = 'home/thibbrun.html.twig';
                break;
        }

        $datas['nbTry'] = $user->getNbTry();
        $datas['progress'] = $user->getProgress();

        return $this->render($view, [
            'controller_name' => 'HomeController',
            'datas' => $datas
        ]);
    }

    #[Route('/start', name: 'app_start')]
    public function start(): Response
    {
        $this->getUser()->setProgress(1);
        $this->entityManager->flush();
        return $this->redirectToRoute('app_home');
    }

    #[Route('/reset', name: 'app_reset')]
    public function reset(): Response
    {
        $this->getUser()->setProgress(0);
        $this->entityManager->flush();
        return $this->redirectToRoute('app_home');
    }

    #[Route('/check/{check}', name: 'app_check')]
    public function check($check): Response
    {
        $goodCheck = [
            '6deae9600c74845c09d69d7c8c5e5db5',
            '5d5b5f5f51abce75f4927f5d4c27b4d8',
            'f2aa9d222cd44e8b1f18b1e767928c48',
            '165ccfde8c18f0a529a46c9fb0e1403f',
            '3a146522d768ef1c72dcf7a2af62c69e',
            '4b9ed4d7647ad8a36b376db7d5a94b5a',
            '0895ab03c5f7b61a9d197a7e8e578c0a',
            '2d6d182b6e8dc6af94c0db719b28f197',
            '7a8de1076b8497a2e91c18652fc6be22',
            '902c33e4b4f9d4f57e893e338c071cf6',
            'd5a5f5e3f4753b17d150e31e9b35e3ec',
            'bb55f3d484ef6391bc672e7ca2a09f2c',
            '2702dcf9cb78869a9682921fca666394',
            'd1d41b08b6de71cf66c12e62ba9b0e9d',
            '05fc52a19cfd617afbc951e21bb8a38a',
            'c43ed556fd71202f466d9fa881e551b1',
            '0d16eb0b60b8a90f812e50b91a7661e7',
            '8ee9f64b6a786c2e93f6e8b2250d39e7',
            'bcb83120a07a0788e9b0d7c93fc641f3',
        ];

        if (in_array($check, $goodCheck)){
            return $this->redirectToRoute('app_name');
        }else{
            return $this->redirectToRoute('app_error');
        }
    }

    #[Route('/name', name: 'app_name')]
    public function name(Request $request): Response
    {
        $progress = $this->getUser()->getProgress();
        $good = 0;
        $image = 'erreur';
        switch ($progress){
            //Arthur
            case 1:
                $good = 12;
                $image = '1/a59097b33cdb3bf9b8991a71fe87dd65.jpg';
                break;

            //Antoine
            case 2:
                $good = 3;
                $image = '2/72b6986b6a13c2dcc52df763cea327af.jpg';
                break;

            //Alexandre
            case 3:
                $good = 6;
                $image = '3/099df458f8af1b13340cabd8882e5e80.png';
                break;

            //Marwane
            case 4:
                $good = 9;
                $image = '4/d804f18bbb3b2af2c13f052e0de4c303.jpg';
                break;

            //Thibbrun
            case 5:
                $good = 1;
                $image = '5/b9824d25372551e62acdb91ce103e675.jpg';
                break;

        }

        $names = array(
            1 => 'Thibault B.',
            2 => 'Rémi',
            3 => 'Antoine',
            4 => 'Adrien',
            5 => 'Bastian',
            6 => 'Alexandre',
            7 => 'Quentin',
            8 => 'Thibault H.',
            9 => 'Marwane',
            10 => 'Nicolas',
            11 => 'Pierre-Ju',
            12 => 'Arthur',
            13 => 'Vivien'
        );


        $formBuilder = $this->createFormBuilder();
        foreach ($names as $id => $name){
            $formBuilder->add($id, SubmitType::class, [
                'label' => $name,
            ]);
        }
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clickedButton = $form->getClickedButton();
            $buttonValue = $clickedButton->getName();
            dump($buttonValue);

            if ($buttonValue == $good){
                $this->getUser()->setProgress($this->getUser()->getProgress() + 1);
                $this->entityManager->flush();
                return $this->redirectToRoute('app_home');
            }else{
                return $this->redirectToRoute('app_error');
            }
        }



        return $this->render('home/name.html.twig', [
            'form' => $form->createView(),
            'image' => $image
        ]);




    }

    #[Route('/error', name: 'app_error')]
    public function error(): Response
    {
        $user = $this->getUser();
        $user->setNbTry($user->getNbTry() - 1);
        $this->entityManager->flush();

        if($user->getNbTry() <= 0)
            return $this->redirectToRoute('app_home');

        $datas['nbTry'] = $user->getNbTry();
        return $this->render('home/error.html.twig', [
            'controller_name' => 'HomeController',
            'datas' => $datas,
        ]);
    }
}
