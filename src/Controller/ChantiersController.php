<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ChantiersRepository;

class ChantiersController extends AbstractController
{
    /**
     * @Route("/chantiers", name="chantiers")
     */
    public function index(ChantiersRepository $chantierRepo)
    {
        $chantiers = $chantierRepo->findAll();
        return $this->render('page/chantiers.html.twig', [
            'title' => 'Chantiers',
            'chantiers' => $chantiers
        ]);
    }
}
