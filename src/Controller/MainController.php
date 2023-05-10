<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{


    #[Route('/', name: 'main_home')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }
    #[Route('/pied', name: 'main_pied')]
    public function pied(): Response
    {
        return $this->render('main/pied.html.twig');
    }
    #[Route('/info', name: 'main_info')]
    public function Info(): Response
    {
        return $this->render('main/info.html.twig');
    }

}
