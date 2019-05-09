<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ad;
use App\Repository\AdRepository;
use App\Service\PaginationService;
use Doctrine\Common\Persistence\ObjectManager;


class SearchTitleController extends AbstractController
{
    /**
     * @Route("/tracklist/search-title/{page<\d+>?1}", name="searchTitle")
     */


    public function orderDate(ObjectManager $manager, PaginationService $pagination,
     $page, AdRepository $repo)
    {
       
        $pagination->setEntityClass(Ad::class)
        ->setPage($page)
        ->setLimit(8);

       $orderAds = $manager->createQuery(
        'SELECT u
        FROM App\Entity\Ad u
        ORDER BY u.title ASC
        ')
                            ->getResult(); 

      
            
        return $this->render('search/searchDate.html.twig', [
            'orderAds' =>$orderAds,
            'pagination' => $pagination,
           
        ]);
    }   
}
