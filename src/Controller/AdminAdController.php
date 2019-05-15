<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Service\PaginationService;

class AdminAdController extends AbstractController
{
    /**
     * @Route("/admin/ads/{page<\d+>?1}", name="admin_ads_index")
     */
    public function index(AdRepository $repo, PaginationService $pagination, $page)
    {
        $pagination->setEntityClass(Ad::class)
        -> setPage($page)
        -> setLimit(5);

        
        return $this->render('admin/ad/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'édition
     *@Route ("/admin/ads/{id}/edit", name="admin_ads_edit")
     *
     * @param Ad $ad
     * @return void
     */
    public function edit(Ad $ad, Request $request, ObjectManager $manager){
        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "La Track <strong>{$ad->getTitle()}</strong> a bien été editée !"
                
            );
        }

        return $this->render('admin/ad/edit.html.twig', [
            'ad' => $ad,
            'form' => $form->createView()
        ]);

    }

    /**
     * permet de supprimer une annonce
     * @Route ("/admin/ads/{id}/delete", name="admin_ads_delete")
     *
     * @param Ad $ad
     * @param ObjectManager $manager
     * @return Reponse
     */
    public function delete(Ad $ad, ObjectManager $manager){

        $manager->remove($ad);
        $manager->flush(

        $this->addFlash(
            'success',
            "La Track <strong>{$ad->getTitle()}</strong> a bien été supprimée !"
        )

        );


        return $this->redirectToRoute('admin_ads_index');
    }
}
