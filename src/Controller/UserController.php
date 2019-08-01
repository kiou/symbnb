<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    public function index(User $user)
    {
        return $this->render('user/index.html.twig',[
            'user' => $user
        ]);
    }
}
