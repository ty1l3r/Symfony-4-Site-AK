<?php

/**====================== AD CONTROLLER ================================
 *======================================================================
 *===============  __  __     __  __     __  __     ====================  
 *=============== /\ \_\ \   /\ \/ /    /\ \_\ \    ==================== 
 *=============== \ \  __ \  \ \  _"-.  \ \  __ \   ====================
 *===============  \ \_\ \_\  \ \_\ \_\  \ \_\ \_\  ====================
 *===============   \/_/\/_/   \/_/\/_/   \/_/\/_/  ====================
 *======================================================================
 *====================================================================*/

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\AdRepository;
use App\Entity\Comment as AppComment;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\PaginationService;

class AdController extends AbstractController 
{

/* ============================== / - HOMEPAGE ================================== */
    /**
     * @Route("/", name="homepage")
     */

    public function home(AdRepository $repo)
    {
        // return new Response("Bonjour"); // Le Response correspond à HttpFoundation\Response
        //render est donné par la classe Controller
        // le tableau dans render intégre la variable "title"
        $ads = $repo->findAll();

        return $this->render('home.html.twig', [
            'ads' => $ads
        ]
    ); 
    }
/* =============================== TRACKLIST - AD ================================= */
    /**
     * @Route("/tracklist/{page<\d+>?1}", name="ad")
     */
    public function index(AdRepository $repo, $page, PaginationService $pagination)
    {   

        //méhode find : permet de retrouver un enregistrement par son identifiant.
        
        $pagination->setEntityClass(Ad::class)
                    -> setPage($page);
        
                    $ads = $repo->findAll();
        
       
        return $this->render('ad/index.html.twig', [

            //'ads' => $pagination->getData(),
            //'pages' => $pagination->getPages(),
            //'page' => $page

            //version optimale
            'pagination' => $pagination,
            'ads' => $ads

        ]);
    }
/* ======================== TRACKLIST/NEW - TR-CREATE ============================= */

    /**
     * Création d'une annonce
     *@Route("/tracklist/new", name="tr-create")
     * @return Response
     */

    public function create(Request $request, ObjectManager $manager, Ad $ad = null)

    /** --------Envoi du Formulaire -------------*/
    {
        //$ad = new Ad();

        if (!$ad) {
            $ad = new Ad();
        }

        $form = $this->createForm(AdType::class, $ad);

        $form->HandleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        
        {
            $ad->setAuthor($this->getUser());
        
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success !', "Le nouvelle track <strong> {$ad->getTitle()} </strong> 
                a bien été ajouté à la Base De Donnée !"
            );

            return $this->redirectToRoute('tr-show',[
                'id' => $ad->getId()
            ]);
        }

        return $this->render('ad/new.html.twig', [
            'form' => $form->createView(),
            /* EDIT MODE POUR CHANGER LE TEXTE DE LA PAGE */
            'editMode' => $ad->getId() !== null
        ]);
    }

/* ==========================  EDITION - TR-EDIT =================================== */

    /**
     * Permet d'afficher le formulaire d'édition
     * @Route("/tracklist/{id}/edit", name="tr-edit")
     * @Security("is_granted('ROLE_USER') and user === ad.getAuthor()", message="Cette annonce ne vous appartient pas, vous ne pouvez pas la modifier")
     * 
     * @return Response
     */

    public function edit(Ad $ad, Request $request, ObjectManager $manager){
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $ad->setAuthor($this->getUser());
        
            $manager->persist($ad);
            $manager->flush();
            $this->addFlash(
                'success !', "Le nouvelle track <strong> {$ad->getTitle()} </strong> 
                a bien été ajouté à la Base De Donnée !"
            );
            return $this->redirectToRoute('tr-show',[
                'id' => $ad->getId()
            ]);
        }
        
        return $this->render('ad/new.html.twig', [
            'form' => $form->createView(),
            /* EDIT MODE POUR CHANGER LE TEXTE DE LA PAGE */
            'editMode' => $ad->getId() !== null
        ]);
    }

/* ==========================  SHOW - TR-SHOW =================================== */


    /**
     * Undocumented function
     *@Route ("/tracklist/{id}", name="tr-show")
     * @param Ad $ad
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     * 
     */
    public function show(Ad $ad, Request $request, ObjectManager $manager)

    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
   

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $comment->setAd($ad);
            $comment->setAuthor($this->getUser());


            $manager->persist($comment);
            $manager->flush();
            $this->addFlash(
                'success',
                "Votre commentaire a bien été pris en compte !"
            );
        }
        return $this->render('ad/show.html.twig', [
         'ad' => $ad,
         'form'    => $form->createView() ,
         'id' => $ad->getId()
        ]);
    }

/* ==========================  DELETE - TR-DEL =================================== */

    /**
     * Permet de supprimer une annonce
     * 
     * @Route("/ads/{id}/delete", name="tr-del")
     * @Security("is_granted('ROLE_USER') and user == ad.getAuthor()", message="Vous n'avez pas le droit d'accéder à cette ressource")
     *
     * @param Ad $ad
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Ad $ad, ObjectManager $manager) {
        $manager->remove($ad);
        $manager->flush();
        $this->addFlash(
            'success',
            "L'annonce <strong>{$ad->getTitle()}</strong> a bien été supprimée !"
        );
        return $this->redirectToRoute("ad");
    }
 


}
