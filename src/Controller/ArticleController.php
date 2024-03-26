<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Reporter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\ArticleType;
use Symfony\Component\Routing\Annotation\Route;



class ArticleController extends AbstractController
{
    public function index(EntityManagerInterface $entityManager): Response
    {
        $articles = $entityManager->getRepository(Article::class)->findAll();

        $data = [];
        foreach ($articles as $article) {
            $data[] = [
                'id' => $article->getId(),
                'title' => $article->getTitle(),
                'content' => $article->getContent(),
            ];
        }

        return $this->render('layout.html.twig', [
            'articles' => $data,
        ]);
    }

    public function home(): Response
    {
        return $this->render('layout.html.twig');
    }

    public function show(EntityManagerInterface $entityManager, $articleId): Response
        {
            $article = $entityManager->getRepository(Article::class)->find($articleId);
            if (!$article) {
                throw $this->createNotFoundException('Article not found');
            }
            
            // Incrémenter le nombre de visiteurs
            $article->setVisitors(1);

            // Enregistrer les changements dans la base de données
            $entityManager->flush();
            return $this->render('article_detail.html.twig', ['article' => $article,
            ]); 
        }
}
