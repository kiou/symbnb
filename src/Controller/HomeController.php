<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller{

    /**
     * @return void
     */
    public function home()
    {
        return $this->render('home.html.twig',
            ['title' => 'Bonjour tout le monde ']
        );
    }

}

?>