<?php

namespace App\Entity;

use App\Repository\ReporterRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReporterRepository::class)]

class Reporter extends User
{

    #[ORM\Column]
    private ?bool $locked = null;

    
    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'reporter')]
    private Collection $articles;



    public function getId(): ?int
    {
        return $this->getId();
    }



    public function isLocked(): ?bool
    {
        return $this->locked;
    }

    public function setLocked(bool $locked): static
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setReporter($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getReporter() === $this) {
                $article->setReporter(null);
            }
        }

        return $this;
    }
}
