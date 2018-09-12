<?php
namespace App\Controller;


use App\Entity\Card;
use App\Entity\Panier;
use App\Entity\User;
use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AffichageDonnee extends AbstractController
{

    public function afficheAction()
    {
      //  $this->setUpDonneeCard();
       //$this->setUpDonneePanier();
        $panier=null;
        $list_Card=null;
        $nc=null;
        $list_Card= $this->recupListCard();
        if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            dump($this->getUser());
            $nc = $this->nbCardParPanier($this->getUser());
            $panier = $this->recupPanier($this->getUser()->getId());
        }
        return $this->render('donnee.html.twig',array('list_card' =>$list_Card, 'panier' =>$panier, 'nbcard' => $nc));
    }

    public function recupAverageQuantityCard(){
        $em = $this->getDoctrine()->getManager();
        $cardRepository = $em->getRepository('App\Entity\Card');
        $list_Card= $cardRepository->getAverageQuantity();

        return $list_Card;
    }

    public function recupListCard()
    {
        $em = $this->getDoctrine()->getManager();
        $cardRepository = $em->getRepository('App\Entity\Card');
        $list_Card= $cardRepository->findAll();
        return $list_Card;
    }

    public function nbCardParPanier($user){
        $pr = $this->getDoctrine()->getRepository('App\Entity\Panier');

        return $pr->getNbCard($user);
    }

    public function recupPanier($user_id)
    {
        $em = $this->getDoctrine()->getManager();
        $panierRepository = $em->getRepository('App\Entity\Panier');
        $panier= $panierRepository->findOneByuser($this->getUser());

        return $panier;
    }

    public function recupOneCard($id){
        $em = $this->getDoctrine()->getManager();
        $cardRepository = $em->getRepository('App\Entity\Card');
        return $cardRepository->findOneByid($id);
    }


    public function addPanier($id){
        $em = $this->getDoctrine()->getManager();
        $card = $this->recupOneCard($id);
        $pr = $em->getRepository('App\Entity\Panier');
        $panier = $pr->findOneBy(array('user'=> $this->getUser()->getId()));
        if($panier == null){
            $panier = new Panier();
            $panier->setUserId($this->getUser());
        }
        $panier->addListeCard($card);
        $card->setQuantity($card->getQuantity()-1);
        $em->persist($card);
        $em->persist($panier);
        $em->flush();
        return $this->redirectToRoute('affichage');
    }

    public function translation($name)
    {
    return $this->render('translation.html.twig',array('name' =>$name));
    }











}