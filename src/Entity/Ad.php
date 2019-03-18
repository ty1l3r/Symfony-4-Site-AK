<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Ad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 8,
     * max = 30,
     * minMessage = " Title must be at least {{ limit }} characters long",
     * maxMessage = "Your first name cannot be longer than {{ limit }} characters")
     */
    private $title;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type(
     * type="float",
     * message="The value {{ value }} is not a valid {{ type }}.")
     */

    private $price;
   /**
    * @ORM\Column(type="string")
    * @Assert\Type(type="string",
    * message="The value {{ value }} is not a valid")
    */

    private $genre;

    /**
     * @ORM\Column(type="time")
     */
    private $duree;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type(type="float",
     * message="The value {{ value }} is not valid")
     * @Assert\Length(
     * min = 4,
     * max = 4,
     * minMessage = " En {{ limit }}  ? Vraiment ?",
     * maxMessage = "  {{ limit }} ? Demain ! C'est loin ;)")
     */

    private $annee;

    /**
     * @ORM\Column(type="float")
     */
    private $tduree;

    /**
     * @ORM\Column(type="string", length=500)
     * @Assert\Url(
     * message = "The url '{{ value }}' is not a valid url",
     * )
     */
    private $image;

    /**
     * Permet d'initialise le slug
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function initialzeSlug()
    {
        if(empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->title);
        }
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getAnnee(): ?float
    {
        return $this->annee;
    }

    public function setAnnee(float $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getTduree(): ?float
    {
        return $this->tduree;
    }

    public function setTduree(float $tduree): self
    {
        $this->tduree = $tduree;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
