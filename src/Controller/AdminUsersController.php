<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Ad;
use App\Repository\AdRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Comment;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use App\Service\PaginationService;

class AdminUsersController extends AbstractController
{
    /**
     * @Route("/admin/users/{page<\d+>?1}", name="admin_users_index")
     */
    public function index(AdRepository $repo, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(User::class)
        -> setPage($page)
        -> setLimit(6);


        return $this->render('admin/users/index.html.twig', [
           
            'pagination' => $pagination,
        
             
    
        ]);
    }

     /**
     * permet de supprimer une annonce
     * @Route ("/admin/users{id}/delete", name="admin_users_delete")
     *
     * @param Ad $ad
     * @param ObjectManager $manager
     * @return Reponse
     */
    public function delete(User $user, ObjectManager $manager){

 
        $manager->remove($user);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'utilisateur <strong></strong> a bien été supprimée !"
        

        );


        return $this->redirectToRoute('admin_users_index');
    }
}
