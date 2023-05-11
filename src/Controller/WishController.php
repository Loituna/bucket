<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('/list', name: 'list')]
    public function list(WishRepository $WR): Response
    {
        $wishes=$WR->findBy(["isPublished"=>true],["dateCreatde"=>"DESC"]);

        return $this->render('wish/list.html.twig',['wishes'=>$wishes] );
    }
    #[Route('/{id}', name: 'detail',requirements: ["id"=>"\d+"])]
    public function detail(int $id ,WishRepository $WR): Response
    {
        dump($id);
        $wish = $WR->find($id);
        return $this->render('wish/detail.html.twig',['wish'=>$wish] );
    }
}
