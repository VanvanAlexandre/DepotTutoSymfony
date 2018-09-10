<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardImageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CardImage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $path;
    /**
     * @Assert\Image(maxSize="2M",minHeight="60",maxSizeMessage="Image trop volumineuse",minHeightMessage="Image trop petite")
     */
    private  $file;

    private $tempFilename;



    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload(){
        if(null == $this->file){
            return;
        }
        dump($this->file);
        $this->path = $this->file->guessExtension();
        $this->nom = $this->file->getClientOriginalName();
        dump($this->path);
        dump($this->nom);
    }


    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }
        if (null !== $this->tempFilename) {
            $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
        $this->file->move(
            $this->getUploadRootDir(),
            $this->id.'.'.$this->path
        );
    }


    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->path;
    }


    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->tempFilename)) {
            unlink($this->tempFilename);
        }
    }


    public function getUploadDir()
    {
        return 'image';
    }


    protected function getUploadRootDir()
    {
        return __DIR__.'/../../public/'.$this->getUploadDir();
    }


    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getId().'.'.$this->getPath();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile(UploadedFile $file): void
    {
        $this->file = $file;
        if(null!== $this->getPath()){
            $this->tempFilename = $this->path;
            $this->path=null;
            $this->nom=null;
        }
    }


}
