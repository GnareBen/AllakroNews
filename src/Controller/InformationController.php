<?php

namespace App\Controller;

use App\Repository\DispensaireRepository;
use App\Repository\PharmacieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InformationController extends AbstractController
{
    #[Route('/informations-utiles', name: 'app_information')]
    public function index(PharmacieRepository $pharmacieRepository, DispensaireRepository $dispensaireRepository): Response
    {
        $pharmacies = $pharmacieRepository->findAll();
        $dispensaires = $dispensaireRepository->findAll();

        return $this->render('information/index.html.twig', [
            'pharmacies' => $pharmacies,
            'dispensaires' => $dispensaires
        ]);
    }
}
