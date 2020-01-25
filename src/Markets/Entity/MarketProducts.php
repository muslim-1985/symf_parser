<?php
declare(strict_types=1);

namespace App\Markets\Entity;

use App\Purchases\Entity\PurchaseCheck;
use App\Markets\Entity\ProductCategory;
use App\User\Entity\UserProduct;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Markets\Repository\MarketProductsRepository")
 */
class MarketProducts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $linkHash;

    /**
     * @ORM\ManyToOne(targetEntity="App\Markets\Entity\Markets", inversedBy="marketProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $market;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity="App\User\Entity\UserProduct", mappedBy="marketProduct", cascade={"persist", "remove"})
     */
    private $userProduct;

    /**
     * @ORM\ManyToOne(targetEntity="App\Markets\Entity\ProductCategory", inversedBy="marketProducts")
     */
    private $productCategory;

    /**
     * @ORM\OneToOne(targetEntity="App\Purchases\Entity\PurchaseCheck", mappedBy="marketProduct", cascade={"persist", "remove"})
     */
    private $purchaseCheck;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImgUrl(): ?string
    {
        return $this->image;
    }

    public function setImgUrl(?string $image): self
    {
        $this->image = $image;

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

    public function getMarket(): ?Markets
    {
        return $this->market;
    }

    public function setMarket(?Markets $market): self
    {
        $this->market = $market;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUserProduct(): ?UserProduct
    {
        return $this->userProduct;
    }

    public function setUserProduct(?UserProduct $userProduct): self
    {
        $this->userProduct = $userProduct;

        // set (or unset) the owning side of the relation if necessary
        $newMarketProduct = null === $userProduct ? null : $this;
        if ($userProduct->getMarketProduct() !== $newMarketProduct) {
            $userProduct->setMarketProduct($newMarketProduct);
        }

        return $this;
    }

    public function getProductCategory(): ?ProductCategory
    {
        return $this->productCategory;
    }

    public function setProductCategory(?ProductCategory $productCategory): self
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link): void
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getLinkHash(): ?string
    {
        return $this->linkHash;
    }

    /**
     * @param string $linkHash
     * @return $this
     */
    public function setLinkHash(string $linkHash): self
    {
        $this->linkHash = $linkHash;

        return $this;
    }

    public function getPurchaseCheck(): ?PurchaseCheck
    {
        return $this->purchaseCheck;
    }

    public function setPurchaseCheck(PurchaseCheck $purchaseCheck): self
    {
        $this->purchaseCheck = $purchaseCheck;

        // set the owning side of the relation if necessary
        if ($purchaseCheck->getMarketProduct() !== $this) {
            $purchaseCheck->setMarketProduct($this);
        }

        return $this;
    }
}
