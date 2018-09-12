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
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

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
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));
            return $this->redirectToRoute('affichage');

        }

        return $this->render('form.html.twig',array('form' => $form->createView()));

    }

}