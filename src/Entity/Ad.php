<?php

namespace App\Entity;
use App\Entity\User;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 * fields={"title"},
 * message="Track Already exist")
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
     * min = 2,
     * max = 100,
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
    * message=" Lettres seulement !")
    */

    private $genre;

    /**
     * @ORM\Column(type="time")
     */
    private $duree;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(
     * min = 4,
     * max = 4,)
     * @Assert\LessThan( value = 2020, message= "Retour vers le futur ??? !" )
     * @Assert\GreaterThan( value = 1900, message=" Je me demande bien quel âge tu as ? ;) !" )
     */

    private $annee;


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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="ad", orphanRemoval=true)
     */
    private $comments;




    /**
     * Permet de récupérer le commentaire d'un auteur par rapport à une annonce
     *
     * @param User $author
     * @return Comment|null
     */
    public function getCommentFromAuthor(User $author){
        foreach($this->comments as $comment) {
            if($comment->getAuthor() === $author) return $comment;
        }
        return null;
    }

    /**
     * Permet d'obtenir la moyenne globale des notes pour cette annonce
     *
     * @return float
     */
    
    public function getAvgRatings(){
        //réduit un tableau en 1 valeur.
        $sum = array_reduce($this->comments->toArray(), function($total, $comment){
            return $total + $comment->getRating();
        }, 0);
        //calculer la somme des notations et faire la division pour la moyenne
        // attention à la division par 0 <O></O>
        if(count($this->comments) > 0) return $sum / count($this->comments);

        return 0;
    }

    public function getId()
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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setAd($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAd() === $this) {
                $comment->setAd(null);
            }
        }

        return $this;
    }

   

  
   
}
