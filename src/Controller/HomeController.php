<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'articles0' =>$articleRepository->findLastOne(),
            'articles1' => $articleRepository->findBySix(),
            'articles2' => $articleRepository->findByTag("UVCI"),
            'articles3' => $articleRepository->findByTag("ALLAKRO")
        ]);
    }
}
