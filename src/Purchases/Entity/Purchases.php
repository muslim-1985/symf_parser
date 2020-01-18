<?php
declare(strict_types=1);

namespace App\Purchases\Entity;

use App\Markets\Entity\Markets;
use App\User\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Purchases\Repository\PurchasesRepository")
 */
class Purchases
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\User\Entity\User", inversedBy="purchases")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $product_name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private string $product_price;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private string $product_market;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \DateTimeInterface $date_of_purchase;

    /**
     * @ORM\ManyToMany(targetEntity="App\Markets\Entity\Markets", inversedBy="purchases")
     */
    private Collection $markets;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private string $check_serial_number;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $created_at;

    public function __construct()
    {
        $this->markets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getProductPrice(): ?string
    {
        return $this->product_price;
    }

    public function setProductPrice(?string $product_price): self
    {
        $this->product_price = $product_price;

        return $this;
    }

    public function getProductMarket(): ?string
    {
        return $this->product_market;
    }

    public function setProductMarket(?string $product_market): self
    {
        $this->product_market = $product_market;

        return $this;
    }

    public function getDateOfPurchase(): ?\DateTimeInterface
    {
        return $this->date_of_purchase;
    }

    public function setDateOfPurchase(?\DateTimeInterface $date_of_purchase): self
    {
        $this->date_of_purchase = $date_of_purchase;

        return $this;
    }

    /**
     * @return Collection|Markets[]
     */
    public function getMarkets(): Collection
    {
        return $this->markets;
    }

    public function addMarket(Markets $market): self
    {
        if (!$this->markets->contains($market)) {
            $this->markets[] = $market;
        }

        return $this;
    }

    public function removeMarket(Markets $market): self
    {
        if ($this->markets->contains($market)) {
            $this->markets->removeElement($market);
        }

        return $this;
    }

    public function getCheckSerialNumber(): ?string
    {
        return $this->check_serial_number;
    }

    public function setCheckSerialNumber(?string $check_serial_number): self
    {
        $this->check_serial_number = $check_serial_number;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
