<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Récupérer les données de l'article à modifier
        $article = $options['data'];

        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'required' => true,
                // Pré-remplir le champ avec le titre actuel de l'article
                'data' => $article->getTitle(),
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Content',
                'required' => true,
                // Pré-remplir le champ avec le contenu actuel de l'article
                'data' => $article->getContent(),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
?>