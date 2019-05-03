<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use App\Service\StatsService;

class AdminDashBoardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dash_board")
     */
    public function index(ObjectManager $manager, StatsService $statsService)
    {
        $stats = $statsService->getStats();

        $bestTracks = $statsService->getAdsStats('DESC');
        $worstTracks = $statsService->getAdsStats('ASC');
      
        return $this->render('admin/dashboard/index.html.twig', [
            //astuce de concaténation PHP
            'stats' => $stats,
            'bestTracks' => $bestTracks,
            'worstTracks' => $worstTracks
        ]);
    }
}
