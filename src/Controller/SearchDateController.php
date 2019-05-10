<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use App\Service\PaginationService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SearchDateController extends AbstractController
{


    
    /**
     * @Route("/tracklist/search-date/{page<\d+>?1}", name="searchDate")
     */


    public function orderDate(ObjectManager $manager, PaginationService $pagination,
     $page, AdRepository $repo)
    {
       

       $orderAds = $manager->createQuery(
        'SELECT u
        FROM App\Entity\Ad u
        ORDER BY u.CreatedAt ASC
        ')
                            ->getResult(); 

        $pagination->setEntityClass(Ad::class)
        ->setPage($page)
        ->setLimit(8);

            
        return $this->render('search/searchDate.html.twig', [
            'orderAds' =>$orderAds,
            'pagination' => $pagination,
           
        ]);
    }   
    
    

 
}
