<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Card")
     */
    private $listeCard;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Panier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->listeCard = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|card[]
     */
    public function getListeCard(): Collection
    {
        return $this->listeCard;
    }

    public function addListeCard(card $listeCard): self
    {
        if (!$this->listeCard->contains($listeCard)) {
            $this->listeCard[] = $listeCard;
        }

        return $this;
    }

    public function removeListeCard(card $listeCard): self
    {
        if ($this->listeCard->contains($listeCard)) {
            $this->listeCard->removeElement($listeCard);
        }

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
