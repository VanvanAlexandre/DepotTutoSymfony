<?php
/**
 * Created by PhpStorm.
 * User: Perso
 * Date: 06/09/2018
 * Time: 12:18
 */

namespace App\Controller\User;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class InscritpionController extends AbstractController
{


    public function inscriptionAction(Request $request){
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user->setSalt('');
            $user->setRoles(array('ROLE_USER'));
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('affichage');

        }

        return $this->render('form.html.twig',array('form' => $form->createView()));

    }

}