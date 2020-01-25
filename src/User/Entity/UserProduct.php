<?php
declare(strict_types=1);

namespace App\User\Entity;

use App\Markets\Entity\MarketProducts;
use App\Purchases\Entity\PaymentMethod;
use App\User\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\User\Repository\UserProductRepository")
 */
class UserProduct
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\User\Entity\User", inversedBy="userProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Purchases\Entity\PaymentMethod", inversedBy="userProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $paymentMethod;

    /**
     * @ORM\OneToOne(targetEntity="App\Markets\Entity\MarketProducts", inversedBy="userProduct", cascade={"persist", "remove"})
     */
    private $marketProduct;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?PaymentMethod $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getMarketProduct(): ?MarketProducts
    {
        return $this->marketProduct;
    }

    public function setMarketProduct(?MarketProducts $marketProduct): self
    {
        $this->marketProduct = $marketProduct;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
