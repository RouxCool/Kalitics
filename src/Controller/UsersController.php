<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsersRepository;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(UsersRepository $usersRepo)
    {
        $users = $usersRepo->findAll();
        return $this->render('page/users.html.twig', [
            'title' => 'Utilisateurs',
            'users' => $users
        ]);
    }
}
