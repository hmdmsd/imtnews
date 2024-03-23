<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleRepository;
use App\Entity\Reporter;

class ReporterController extends AbstractController
{
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Assuming you have a method in ArticleRepository to fetch articles by reporter
        $reporterId = 1;
        $reporter =  $entityManager->getRepository(Reporter::class)->find($reporterId); 
        $articles = $articleRepository->findByReporter($reporter); // You need to implement this method in ArticleRepository

        // Render the view and pass articles data to it
        return $this->render('reporter/reporter_profile.html.twig', [
            'articles' => $articles,
        ]);
    }
}
