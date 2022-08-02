<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CheckRepository;

use App\Repository\ChantiersRepository;
use App\Repository\PointagesRepository;
use App\Repository\UsersRepository;

class CheckController extends AbstractController
{
    /**
     * @Route("/check", name="check_form")
     */
    public function index(Request $request, PointagesRepository $pointageRepo)
    {
        if ($request->request->count() > 0) {
            $matricule = $request->request->get('matricule');
            $chantier = $request->request->get('chantier');

            $checks = $pointageRepo->findByMatriculeChantier($matricule, $chantier);
        } else {
            $matricule = null;
            $chantier = null;
            $checks = [];
        }

        return $this->render('page/check.html.twig', [
            'title' => 'Contrôle Pointages',
            'checks' => $checks,
            'matricule' => $matricule,
            'chantier' => $chantier,
        ]);
    }
}
