<?php
declare(strict_types=1);

namespace App\Markets\Entity;

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
    private int $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private string $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $img_url;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Markets\Entity\Markets", inversedBy="marketProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private Markets $market;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $created_at;

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
        return $this->img_url;
    }

    public function setImgUrl(?string $img_url): self
    {
        $this->img_url = $img_url;

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
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
