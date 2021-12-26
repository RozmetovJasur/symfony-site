<?php

namespace App\Entity;

use App\Entity\Traits\TimeStampableEntity;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    use TimeStampableEntity;
    public const PUBLISHED = true;
    public const NOT_PUBLISHED = false;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1500)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="integer",length=10,nullable=false)
     */
    private int $price = 0;

    /**
     * @var float|int
     * @ORM\Column(type="decimal",precision=12,scale=2,options={"default":0})
     */
    private float $discount = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_publish;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getIsPublish(): ?bool
    {
        return $this->is_publish;
    }

    public function setIsPublish()
    {
        $this->is_publish = self::PUBLISHED;
    }

    public function setNotPublish()
    {
        $this->is_publish = self::NOT_PUBLISHED;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return float|int
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param float|int $discount
     */
    public function setDiscount($discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}
