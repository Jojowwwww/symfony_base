<?php

namespace App\Entity;

use App\Repository\OignonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OignonRepository::class)]
class Oignon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
 
    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    public function getId(): ?int{
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getName(): ?string{
        return $this->name;
    }

    public function setName($name): void {
        $this->name = $name;
    }
}
