<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCommentController extends AbstractController
{
    /**
     * @Route("/admin/comments", name="admin_comment_index")
     */
    public function index(AdRepository $repo)
    {

        $repo = $this->getDoctrine()->getRepository(Comment::class);
 

        $comments = $repo->findAll();

        return $this->render('admin/comments/index.html.twig', [
            'comments' => $comments,
            
            
        ]);
    }

    /**
     * Permet d'éditer les commentaires
     *@Route ("admin/comments/{id}/edit", name="admin_comm_edit")
     * @param AdRepository $repo
     * @param Ad $ad
     * @return void
     */
    public function edit(Comment $comment, Request $request, ObjectManager $manager, Ad $ad){
        
    
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'édition des commentaires de la track <strong>{$ad->getSlug()} </strong>a bien été editée !"
                
            );
        }

        return $this->render('admin/comments/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView()
        ]);

    }

        /**
     * permet de supprimer une annonce
     * @Route ("/admin/comments/{id}/delete", name="admin_comm_delete")
     *
     * @param Ad $ad
     * @param ObjectManager $manager
     * @return Reponse
     */
    public function delete(Comment $comment, ObjectManager $manager){

        $manager->remove($comment);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le Commentaire <strong>{$comment->getContent()}</strong> a bien été supprimée !"
        

        );


        return $this->redirectToRoute('admin_comment_index');
    }
    
}
