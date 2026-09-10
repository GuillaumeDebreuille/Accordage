<?php

namespace App\Entity;

use App\Repository\PurchaseLessonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PurchaseLessonRepository::class)]
class PurchaseLesson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $pricePaid = null;

    #[ORM\Column(length: 20)]
    private ?string $purchaseType = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    private ?LessonPack $lessonPack = null;

    #[ORM\ManyToOne]
    private ?Lesson $lesson = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPricePaid(): ?string
    {
        return $this->pricePaid;
    }

    public function setPricePaid(string $pricePaid): static
    {
        $this->pricePaid = $pricePaid;

        return $this;
    }

    public function getPurchaseType(): ?string
    {
        return $this->purchaseType;
    }

    public function setPurchaseType(string $purchaseType): static
    {
        $this->purchaseType = $purchaseType;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getLessonPack(): ?LessonPack
    {
        return $this->lessonPack;
    }

    public function setLessonPack(?LessonPack $lessonPack): static
    {
        $this->lessonPack = $lessonPack;

        return $this;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): static
    {
        $this->lesson = $lesson;

        return $this;
    }
}
