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
        $matricule = null;
        $chantier = null;
        $date = null;
        $checks = [];
        $now = date('d-m-Y');
        if ($request->request->count() > 0) {
            $date = new \DateTime($request->request->get('date'));
            $matricule = $request->request->get('matricule');
            $chantier = $request->request->get('chantier');
            if (null != $matricule && $chantier && $date) {
                $checks = $pointageRepo->findByMatriculeChantierDate($matricule, $chantier, $date);
            } elseif (null != $matricule && $chantier) {
                $checks = $pointageRepo->findByMatriculeChantier($matricule, $chantier);
            } elseif (null != $matricule) {
                $checks = $pointageRepo->findByMatricule($matricule);
            } elseif (null != $chantier) {
                $checks = $pointageRepo->findByChantier($chantier);
                /*$checks = $pointageRepo->findByAll([
                    'chantier' => $chantier
                ]);*/
            }
        }

        return $this->render('page/check.html.twig', [
            'title' => 'Contrôle Pointages',
            'checks' => $checks,
            'matricule' => $matricule,
            'chantier' => $chantier,
            'date' => $date,
            'now' => $now,
        ]);
    }
}
