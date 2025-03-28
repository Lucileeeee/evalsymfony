<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(
        message:"Le titre doit être non vide"
    )]
    #[Assert\Length(
        min: 3,
        max: 50,
        message: 'le titre doit faire entre 3 et 50 caractères',
    )]
    private ?string $title =  null;

   

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(
        message:"Le contenu doit être non vide"
    )]
    private ?string $content = null;



    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
    public function getContent(): ?string
    {
        return $this->title;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

}
