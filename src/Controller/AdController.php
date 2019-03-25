<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\User;


class AdController extends AbstractController 
{



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

     /**========================================================== */

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

    /**========================================================== */

    /**
     * Création d'une annonce
     *@Route("/tracklist/new", name="tr-create")
     *@Route("/tracklist/{id}/edit", name="tr-edit")
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


/** ------------EO message d'alerte -------- */

        if($form->isSubmitted() && $form->isValid())
        {
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
    /** ----------------------------------- */      
       

        return $this->render('ad/new.html.twig', [
            'form' => $form->createView()
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
    * @Route ("/track/{id}/del", name ="tr-del")
    *
    */
   
    public function deleteArticleAction($id, AdRepository $repo, Ad $ad)
    {
        $em = $this->getDoctrine()->getManager();
       // $repo = $em->getRepository($repo);
       $ad = $repo->find($id);

        if($id <= 0)
        {
            throw $this->createNotFoundException('No for'.$id);
        }
        else 
        {
        $em->remove($ad);
        $em->flush();
        }

        return $this->redirectToRoute('ad');
    }



}
