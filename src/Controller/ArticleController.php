<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

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
            return $this->render('article_detail.html.twig', [
                'article' => $article,
            ]);
        }

    
}
