<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('/list', name: 'list')]
    public function list(WishRepository $WR): Response
    {
        $wishes=$WR->findBy(["isPublished"=>true],["dateCreated"=>"DESC"]);

        return $this->render('wish/list.html.twig',['wishes'=>$wishes] );
    }
#[IsGranted('ROLE_USER')]
    #[Route('/add', name: 'add')]
    public function ajout(Request $request, WishRepository $wishRepository){



        $wish = new Wish();

        $wish->setAuthor($this->getUser()->getPseudo());

        $wishForm = $this->createForm(WishType::class,$wish);


        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted()&& $wishForm->isValid()){

            $wish->setDateCreated((new \DateTime()));
            $wish->setIsPublished(true);
            $wishRepository->save($wish,true);

            $this->addFlash('succes','Wish added');

            return $this->render('wish/detail.html.twig',['id'=>$wish->getId(),'wish'=>$wish]);

        }


        return $this->render('wish/add.html.twig',["wishForm"=>$wishForm->createView()]);






}

    #[Route('/{id}', name: 'detail',requirements: ["id"=>"\d+"])]
    public function detail(int $id ,WishRepository $WR): Response
    {
        dump($id);
        $wish = $WR->find($id);
        return $this->render('wish/detail.html.twig',['wish'=>$wish] );
    }



}
