<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardRepository")
 */
class Card
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(min=2, minMessage="Le nom doit faire au moins 3 caractère")
     *
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("int")
     *
     */
    private $atk;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("int")
     *
     */
    private $def;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(min=4, minMessage="Le type le plus court est aqua, il faut au moins 4 caractère")
     * @Assert\Regex(pattern="[a-zA-Z]", match=false, message="Le type ne doit pas contenir de chiffre")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("int")
     */
    private $quantity;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CardImage", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAtk(): ?int
    {
        return $this->atk;
    }

    public function setAtk(int $atk): self
    {
        $this->atk = $atk;

        return $this;
    }

    public function getDef(): ?int
    {
        return $this->def;
    }

    public function setDef(int $def): self
    {
        $this->def = $def;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getImage(): ?CardImage
    {
        return $this->image;
    }

    public function setImage(CardImage $image): self
    {
        $this->image = $image;

        return $this;
    }
}
