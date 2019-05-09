<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ad;
use App\Repository\AdRepository;
use App\Service\PaginationService;
use Doctrine\Common\Persistence\ObjectManager;


class SearchGenreController extends AbstractController
{
    /**
     * @Route("/tracklist/search-OST/{page<\d+>?1}", name="searchGenreOST")
     */
    public function orderGenreOst(ObjectManager $manager, PaginationService $pagination,
     $page, AdRepository $repo)
    {
        $pagination->setEntityClass(Ad::class)
        ->setPage($page)
        ->setLimit(8);

       $genreAds = $manager->createQuery(
        "SELECT u
        FROM App\Entity\Ad u
        WHERE u.genre LIKE 'Original%'
        ")
                            ->getResult();        
        return $this->render('search/searchGenre.html.twig', [
            'genreAds' =>$genreAds,
            'pagination' => $pagination,
              
        ]);
    }  

    /**
     * @Route("/tracklist/search-HipHop/{page<\d+>?1}", name="searchGenreHipHop")
     */
    public function orderGenreHH(ObjectManager $manager, PaginationService $pagination,
     $page, AdRepository $repo)
    {
        $pagination->setEntityClass(Ad::class)
        ->setPage($page)
        ->setLimit(8);

       $genreAds = $manager->createQuery(
        "SELECT u
        FROM App\Entity\Ad u
        WHERE u.genre LIKE 'Hip%'
        ")
                            ->getResult();        
        return $this->render('search/searchGenre.html.twig', [
            'genreAds' =>$genreAds,
            'pagination' => $pagination,
              
        ]);
    }  
    
        /**
     * @Route("/tracklist/search-IndieMusic/{page<\d+>?1}", name="searchGenreIndie")
     */
    public function orderGenreIndie(ObjectManager $manager, PaginationService $pagination,
     $page, AdRepository $repo)
    {
        $pagination->setEntityClass(Ad::class)
        ->setPage($page)
        ->setLimit(8);

       $genreAds = $manager->createQuery(
        "SELECT u
        FROM App\Entity\Ad u
        WHERE u.genre LIKE 'Indi%'
        ")
                            ->getResult();        
        return $this->render('search/searchGenre.html.twig', [
            'genreAds' =>$genreAds,
            'pagination' => $pagination,
              
        ]);
    }  

    /**
     * @Route("/tracklist/search-SoundDesign/{page<\d+>?1}", name="searchGenreSound")
     */
    public function orderGenreSoundD(ObjectManager $manager, PaginationService $pagination,
     $page, AdRepository $repo)
    {
        $pagination->setEntityClass(Ad::class)
        ->setPage($page)
        ->setLimit(8);

       $genreAds = $manager->createQuery(
        "SELECT u
        FROM App\Entity\Ad u
        WHERE u.genre LIKE 'Sound%'
        ")
                            ->getResult();        
        return $this->render('search/searchGenre.html.twig', [
            'genreAds' =>$genreAds,
            'pagination' => $pagination,
              
        ]);
    }  

    /**
     * @Route("/tracklist/search-Jazz/{page<\d+>?1}", name="searchGenreJazz")
     */
    public function orderGenreJazz(ObjectManager $manager, PaginationService $pagination,
     $page, AdRepository $repo)
    {
        $pagination->setEntityClass(Ad::class)
        ->setPage($page)
        ->setLimit(8);

       $genreAds = $manager->createQuery(
        "SELECT u
        FROM App\Entity\Ad u
        WHERE u.genre LIKE 'Jazz%'
        ")
                            ->getResult();        
        return $this->render('search/searchGenre.html.twig', [
            'genreAds' =>$genreAds,
            'pagination' => $pagination,
              
        ]);
    }  

    /**
     * @Route("/tracklist/search-Experimental/{page<\d+>?1}", name="searchGenreExperimental")
     */
    public function orderGenreExp(ObjectManager $manager, PaginationService $pagination,
     $page, AdRepository $repo)
    {
        $pagination->setEntityClass(Ad::class)
        ->setPage($page)
        ->setLimit(8);

       $genreAds = $manager->createQuery(
        "SELECT u
        FROM App\Entity\Ad u
        WHERE u.genre LIKE 'Exp%'
        ")
                            ->getResult();        
        return $this->render('search/searchGenre.html.twig', [
            'genreAds' =>$genreAds,
            'pagination' => $pagination,
              
        ]);
    }  

    /**
     * @Route("/tracklist/search-Electro/{page<\d+>?1}", name="searchGenreElectro")
     */
    public function orderGenreElectro(ObjectManager $manager, PaginationService $pagination,
     $page, AdRepository $repo)
    {
        $pagination->setEntityClass(Ad::class)
        ->setPage($page)
        ->setLimit(8);

       $genreAds = $manager->createQuery(
        "SELECT u
        FROM App\Entity\Ad u
        WHERE u.genre LIKE 'Electro%'
        ")
                            ->getResult();        
        return $this->render('search/searchGenre.html.twig', [
            'genreAds' =>$genreAds,
            'pagination' => $pagination,
              
        ]);
    }  
}
