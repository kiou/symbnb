<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Repository\AdRepository;
use App\Repository\UserRepository;

class HomeController extends Controller{

    /**
     * @return void
     */
    public function home(AdRepository $adRepo, UserRepository $userRepo)
    {
        return $this->render('home.html.twig',[
            'ads' => $adRepo->findBestAds(3),
            'users' => $userRepo->findBestUsers(2)
        ]);
    }

}

?>