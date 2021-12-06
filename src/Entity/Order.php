<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 */
class Order
{
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
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $update_at;

    /**
     * @ORM\Column(type="datetime_immutable",nullable=true)
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTime();
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
    public function getUpdateAt(): \DateTime
    {
        return $this->update_at;
    }

    /**
     * @param \DateTime $update_at
     */
    public function setUpdateAt(\DateTime $update_at): void
    {
        $this->update_at = $update_at;
    }

    /**
     * @return \DateTime
     */
    public function getAcceptedAt(): \DateTime
    {
        return $this->accepted_at;
    }

    /**
     * @param \DateTime $accepted_at
     */
    public function setAcceptedAt(\DateTime $accepted_at): void
    {
        $this->accepted_at = $accepted_at;
    }
}
