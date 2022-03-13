<?php

namespace App\Entity;

use App\Entity\Traits\TimeStampableEntity;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    use TimeStampableEntity;

    public const STATUS_ACTIVE = 0;
    public const STATUS_IN_ACTIVE = 1;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $title;

    /**
     * @ORM\OneToOne(targetEntity=Category::class, cascade={"persist", "remove"})
     */
    private ?self $parent = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $image = null;

    /**
     * @ORM\Column(type="smallint", nullable=true,options={"default":0})
     */
    private ?int $status = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getParentId(): ?self
    {
        return $this->parent_id;
    }

    public function setParentId(?self $parent_id): self
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public static function getStatusLabel()
    {
        return [
            self::STATUS_ACTIVE => "Aktiv",
            self::STATUS_IN_ACTIVE => "Aktiv emas"
        ];
    }

    public function getStatusText()
    {
        $status = self::getStatusLabel();
        return array_key_exists($this->getStatus(), $status) ? $status[$this->getStatus()] : " - ";
    }
}
