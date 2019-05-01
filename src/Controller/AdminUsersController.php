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

class AdminUsersController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_users_index")
     */
    public function index(AdRepository $repo)
    {
        $repo = $this->getDoctrine()->getRepository(User::class);

        $users = $repo->findAll();

        return $this->render('admin/users/index.html.twig', [
            'users' => $users,
    
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
            "Le Commentaire <strong></strong> a bien été supprimée !"
        

        );


        return $this->redirectToRoute('admin_users_index');
    }
}
