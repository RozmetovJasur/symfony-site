<?php

namespace App\Entity;

use App\Entity\Traits\TimeStampableEntity;
use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 */
class Order
{
    use TimeStampableEntity;

    public const STATUS_NEW = 0;
    public const STATUS_ACCEPTED = 1;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(nullable=false)
     */
    private Product $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    /**
     * @var int
     * @ORM\Column(type="integer",nullable=true)
     */
    private int $sum = 0;

    /**
     * @var float|int
     * @ORM\Column(type="decimal",precision=12, scale=2,options={"default":0},nullable=true)
     */
    private float $discount = 0;


    /**
     * @ORM\Column(type="smallint",length=3)
     */
    private int $status = 0;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $accepted_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function setStatusNew()
    {
        $this->status = self::STATUS_NEW;
    }

    public function setStatusAccepted()
    {
        $this->status = self::STATUS_ACCEPTED;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getAcceptedAt(): \DateTime
    {
        return $this->accepted_at;
    }

    /**
     * @param \DateTimeInterface $accepted_at
     * @return void
     */
    public function setAcceptedAt(\DateTimeInterface $accepted_at): void
    {
        $this->accepted_at = $accepted_at;
    }
}
