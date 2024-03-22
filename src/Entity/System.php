<?php

namespace App\Entity;

use App\Repository\SystemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SystemRepository::class)]
#[ORM\Table(name: '`system`')]
class System
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    private ?Collection $users = null;

    private ?Collection $articles = null;
    
    private ?Collection $admins = null;

    private ?Collection $tags = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->admins = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?Collection
    {
        return $this->users;
    }

    public function setUsers(Collection $users): void
    {
        $this->users = $users;
    }

    public function getArticles(): ?Collection
    {
        return $this->articles;
    }

    public function setArticles(Collection $articles): void
    {
        $this->articles = $articles;
    }

    public function getAdmins(): ?Collection
    {
        return $this->admins;
    }

    public function setAdmins(Collection $admins): void
    {
        $this->admins = $admins;
    }

    public function getTags(): ?Collection
    {
        return $this->tags;
    }

    public function setTags(Collection $tags): void
    {
        $this->tags = $tags;
    }
}
