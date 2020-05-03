<?php
declare(strict_types=1);

namespace App\Market\Purchases\Model\Entity;

use App\Statistic\Purchase\Model\Entity\MarketProducts;
use App\Purchases\Entity\PaymentMethod;
use App\Markets\Entity\Markets;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Purchases\Repository\ReceiptRepository")
 */
class Receipt
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
    private $productName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $serialNumber;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $filePath;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateOfPurchase;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Markets\Entity\Markets", inversedBy="checks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $market;

    /**
     * @ORM\ManyToOne(targetEntity="App\Purchases\Entity\Purchases", inversedBy="checks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $purchase;

    /**
     * @ORM\ManyToOne(targetEntity="App\Purchases\Entity\PaymentMethod", inversedBy="checks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $paymentMethod;

    /**
     * @ORM\OneToOne(targetEntity="App\Markets\Entity\MarketProducts", inversedBy="purchaseCheck", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $marketProduct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

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

    public function getFilepath(): ?string
    {
        return $this->filePath;
    }

    public function setFilepath(string $filePath): self
    {
        $this->$filePath = $filePath;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(?string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getDateOfPurchase(): ?\DateTimeInterface
    {
        return $this->dateOfPurchase;
    }

    public function setDateOfPurchase(?\DateTimeInterface $dateOfPurchase): self
    {
        $this->dateOfPurchase = $dateOfPurchase;

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

    public function getMarket(): ?Markets
    {
        return $this->market;
    }

    public function setMarket(?Markets $market): self
    {
        $this->market = $market;

        return $this;
    }

    public function getPurchase(): ?Purchase
    {
        return $this->market;
    }

    public function setPurchase(?Purchase $purchase): self
    {
        $this->purchase = $purchase;

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

    public function setMarketProduct(MarketProducts $marketProduct): self
    {
        $this->marketProduct = $marketProduct;

        return $this;
    }
}
