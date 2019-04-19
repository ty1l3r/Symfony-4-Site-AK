<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController 
{

/* ============================================================================================== */
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
/* ================================================================================ */
    /**
     * @Route("/tracklist", name="ad")
     */
    public function index(AdRepository $repo)
    {   

        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }

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

/* ============================================================================================== */

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

                            








     /**========================================================== */

    /**
     * Undocumented function
     *@Route ("/tracklist/{id}", name="tr-show")
     * 
     */
    public function show(Ad $ad)

    {
        return $this->render('ad/show.html.twig', [
         'ad' => $ad
            
        ]);
    }

     /**========================================================== */

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
