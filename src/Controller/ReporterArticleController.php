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
use App\Form\EditArticleType;
use Symfony\Component\Routing\Annotation\Route;

class ReporterArticleController extends AbstractController
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
            return $this->render('reporter_article_detail.html.twig', [
                'article' => $article,
            ]);
        }
    
    public function add(Request $request, EntityManagerInterface $em): Response
        {
            // Create a new Article entity
            $article = new Article();
            // Create the form
            $form = $this->createForm(ArticleType::class, $article);
            // Handle form submission
            $form->handleRequest($request);
            
            // If form is submitted and valid, persist the article to the database
            if ($form->isSubmitted() && $form->isValid()) {
                // Set additional properties of the article
                $article->setDate(new \DateTime());
                $article->setVisitors(0);
                // Retrieve the reporter (adjust this logic based on your application)
                $reporterId = 1;
                $reporter = $em->getRepository(Reporter::class)->find($reporterId); 
                if (!$reporter) {
                    throw $this->createNotFoundException('Reporter not found');
                }
                $article->setReporter($reporter);
                // Persist the article
                $em->persist($article);
                $em->flush();
            }
            return $this->render('add_article_form.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    public function edit(Request $request, EntityManagerInterface $em, $articleId): Response
    {
        $article = $em->getRepository(Article::class)->find($articleId);

        // Si l'article n'existe pas, retourner une erreur 404
        if (!$article) {
            throw $this->createNotFoundException('Article not found');
        }

        // Créer le formulaire pour éditer l'article
        $form = $this->createForm(EditArticleType::class, $article);
        
        // Gérer la soumission du formulaire
        $form->handleRequest($request);
        
        // Si le formulaire est soumis et valide, mettre à jour l'article dans la base de données
        if ($form->isSubmitted() && $form->isValid()) {
            // Persister les changements dans la base de données
            $em->flush();

            // Rediriger vers la page de détail de l'article
            return $this->redirectToRoute('reporter_article_detail', ['articleId' => $article->getId()]);
        }
        
        // Rendre le template du formulaire d'édition
        return $this->render('edit_article_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
   
    public function delete(EntityManagerInterface $em, $articleId): Response
    {
        $article = $em->getRepository(Article::class)->find($articleId);
        if (!$article) {
            throw $this->createNotFoundException('Article not found');
        }
        
        $em->remove($article);
        $em->flush();
        
        // Redirect to articles list or any other page after deletion
        return $this->redirectToRoute('articles'); // assuming the route name for the articles list is "articles"
    }
    
}
