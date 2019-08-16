<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use App\Services\StatsService;

class AdminDashboardController extends AbstractController
{

    public function index(ObjectManager $manager, StatsService $statsService)
    {

        $stats = $statsService->getStats();
        $bestAds = $statsService->getAdsStats('DESC');
        $worstAds = $statsService->getAdsStats('ASC');

        return $this->render('admin/dashboard/index.html.twig', [
          'stats' => $stats,
          'bestAds' => $bestAds,
          'worstAds' => $worstAds
        ]);
    }
}
