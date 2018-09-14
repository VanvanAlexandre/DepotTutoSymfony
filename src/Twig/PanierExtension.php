<?php

namespace App\Twig;

use App\Entity\Panier;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PanierExtension extends AbstractExtension
{


    public function getFunctions(): array
    {
        return [
            new TwigFunction('panierDisplay', [$this, 'display']),
        ];
    }

    public function display(Panier $panier): String
    {
        // ...
        $res = "Il y a ";
        $res .= count($panier->getListeCard());
        $res .= ' carte(s) dans son panier !\n';
        foreach ($panier->getListeCard() as $card){
            $res.= 'Nom de carte : '.$card->getName().' => '.$card->getPrix().' €\n';
        }
        return $res;
    }
}
