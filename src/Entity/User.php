<?php
namespace App\Entity;
use App\Entity\Ad;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"email"}, message= "User already exist")
 */
class User implements UserInterface
{   

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ Obligatoire")
     * @Assert\Length(min = 2, minMessage="Spice de petit troll nananana ! ")
     * @Assert\Valid
     * @Assert\NotNull
     */
    private $firstName;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ Obligatoire")
     * @Assert\Length(min = 2, minMessage="Spice de petit troll er  ! ")
     * @Assert\Valid
     * @Assert\NotNull
     */
    private $lastName;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(message="Entrez une Url valide !")
     */
    private $picture;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=10, minMessage="Au moins 10 lettres mon coco ! ")
     */
    private $introduction;
    /**
     * @Assert\EqualTo(propertyPath="hash")
     */
    public $passwordConfirm;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ad", mappedBy="author")
     */
    private $ads;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", mappedBy="users")
     */
    private $userRoles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="author", orphanRemoval=true)
     */
    private $comments;


    public function getFullName()
    {
        return "{$this->firstname} {$this->lastName}";
    }
    /**
     * Permet d'initialiser le slug
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeSlug() 
    {
        if(empty($this->slug)){
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->firstName . ' ' . $this->lastName);
        }
    }
    public function __construct()
    {
        $this->ads = new ArrayCollection();
        $this->userRoles = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }
    public function getLastName(): ?string
    {
        return $this->lastName;
    }
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    public function getPicture(): ?string
    {
        return $this->picture;
    }
    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;
        return $this;
    }
    public function getHash(): ?string
    {
        return $this->hash;
    }
    public function setHash(string $hash): self
    {
        $this->hash = $hash;
        return $this;
    }
    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }
    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;
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
    /**
     * @return Collection|Ad[]
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }
    public function addAd(Ad $ad): self
    {
        if (!$this->ads->contains($ad)) {
            $this->ads[] = $ad;
            $ad->setAuthor($this);
        }
        return $this;
    }
    public function removeAd(Ad $ad): self
    {
        if ($this->ads->contains($ad)) {
            $this->ads->removeElement($ad);
            // set the owning side to null (unless already changed)
            if ($ad->getAuthor() === $this) {
                $ad->setAuthor(null);
            }
        }
        return $this;
    }
    //  IMPLEMENTATION USERINTERFACE COMPLEMENTS
    public function getRoles() {
    
        $roles=$this->userRoles->map(function($role){
           return $role->getTitle();

        })->toArray();

        $roles[] = 'ROLE_USER';

        return $roles;
    }

    public function getPassword()
    {
        return $this->hash;
    }
    public function getSalt() {}
    public function getUsername()
    {
       return $this->email; 
    }
    public function eraseCredentials(){}

    /**
     * @return Collection|Role[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRoles->contains($userRole)) {
            $this->userRoles->removeElement($userRole);
            $userRole->removeUser($this);
        }

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
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

   
}
