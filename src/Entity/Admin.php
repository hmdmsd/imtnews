<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ORM\Table(name: '`admin`')]
class Admin extends User
{

    public function lock(Reporter $reporter): void
    {
        $reporter->setLocked(true);
    }

    public function unlock(Reporter $reporter): void
    {
        $reporter->setLocked(false);
    }
}
