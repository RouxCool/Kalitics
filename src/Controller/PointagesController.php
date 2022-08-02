<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PointagesRepository;

class PointagesController extends AbstractController
{
    /**
     * @Route("/pointages", name="pointages")
     */
    
    public function index(PointagesRepository $pointageRepo)
    {
        $pointages = $pointageRepo->findAll();
        return $this->render('page/pointages.html.twig', [
            'title' => 'Pointages',
            'pointages' => $pointages
        ]);
    }
}
