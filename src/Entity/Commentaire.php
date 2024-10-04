<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $name;

    #[ORM\ManyToOne(targetEntity: Burger::class, inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private $burger;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getBurger(): Burger
    {
        return $this->burger;
    }

    public function setBurger(Burger $burger): self
    {
        $this->burger = $burger;
        return $this;
    }
}