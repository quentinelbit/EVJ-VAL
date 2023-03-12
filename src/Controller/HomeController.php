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
            case 6:
                $view = 'home/bastian.html.twig';
                break;
            case 7:
                $view = 'home/quentin.html.twig';
                break;
            case 8:
                $view = 'home/vivien.html.twig';
                break;
            case 9:
                $view = 'home/pj.html.twig';
                break;
            case 10:
                $view = 'home/remi.html.twig';
                break;
            case 11:
                $view = 'home/adrien.html.twig';
                break;
            case 12:
                $view = 'home/nicolas.html.twig';
                break;
            case 13:
                $view = 'home/thibaulth.html.twig';
                break;

            case 14:
                $view = 'home/fini.html.twig';
                $user->setNbTry(99);
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
            '6deae9600c74845c09d69d7c8c5e5db5', //pris
            '5d5b5f5f51abce75f4927f5d4c27b4d8', //pris
            'f2aa9d222cd44e8b1f18b1e767928c48', //pris
            '165ccfde8c18f0a529a46c9fb0e1403f', //pris
            '3a146522d768ef1c72dcf7a2af62c69e', //pris
            '4b9ed4d7647ad8a36b376db7d5a94b5a', //pris
            '0895ab03c5f7b61a9d197a7e8e578c0a', //pris
            '2d6d182b6e8dc6af94c0db719b28f197', //pris
            '7a8de1076b8497a2e91c18652fc6be22', //pris
            '902c33e4b4f9d4f57e893e338c071cf6', //pris
            'd5a5f5e3f4753b17d150e31e9b35e3ec', //pris
            'bb55f3d484ef6391bc672e7ca2a09f2c', //pris
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
                $image = '3/099df458f8af1b13340cabd8882e5e80.jpg';
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

            //Bast
            case 6:
                $good = 5;
                $image = '6/2f615086031d7c3d603c14476604478f.jpg';
                break;

            //Kent
            case 7:
                $good = 7;
                $image = '7/GOOD.jpg';
                break;

            //Vivien
            case 8:
                $good = 13;
                $image = '8/GOOD.jpg';
                break;

            //PJ
            case 9:
                $good = 11;
                $image = '9/g7596666af6df3ac95a8d29532adb913.jpg';
                break;

            //REMI
            case 10:
                $good = 2;
                $image = '10/ad606f3aa32dd2e8f2846eb923333ab8.jpg';
                break;

            //ADRIEN
            case 11:
                $good = 4;
                $image = '11/1256d7bccf598f1f6f81b30bca927a09.jpg';
                break;

            //NICO
            case 12:
                $good = 10;
                $image = '12/0071c796baf44de747f923e8977b7039.jpg';
                break;

            //THIBH
            case 13:
                $good = 8;
                $image = '13/f3747744214e34dd1957f8fc12d4bbf9.png';
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
