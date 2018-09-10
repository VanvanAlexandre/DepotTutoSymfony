<?php

namespace App\Controller;

use App\Form\CardType;
use App\Entity\Card;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function index()
    {
        return $this->render('add/index.html.twig', [
            'controller_name' => 'AddController',
        ]);
    }


    public function add(Request $request){
        $card = new  Card();
        $form = $this->createForm(CardType::class, $card);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($card);
            $em->flush();
            $this->addFlash('notice','Your card has been saved');
            return $this->redirect($request->getUri());
        }

        return $this->render('form.html.twig',array('form' => $form->createView()));
    }
}
