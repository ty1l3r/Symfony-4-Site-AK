<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ad;
use App\Repository\AdRepository;
use App\Service\PaginationService;
use Doctrine\Common\Persistence\ObjectManager;


class SearchPriceController extends AbstractController
{
    /**
     * @Route("/tracklist/search-price/{page<\d+>?1}", name="searchPrice")
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
        ORDER BY u.price ASC
        ')
                            ->getResult(); 

      
            
        return $this->render('search/searchDate.html.twig', [
            'orderAds' =>$orderAds,
            'pagination' => $pagination,
           
        ]);
    }   
}
