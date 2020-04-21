<?php
declare(strict_types=1);

namespace App\Market\Markets\Model\Entity;

use App\User\Entity\UserProduct;
use App\Purchases\Entity\PurchaseCheck;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="MarketRepository")
 */
class Market
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
    private string $name;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private string $relatedName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $link;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(
     *     type="bool",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private bool $isActive = true;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Markets\Entity\MarketProducts", mappedBy="market", orphanRemoval=true)
     */
    private $marketProducts;

    /**
     * @ORM\OneToMany(targetEntity="App\Purchases\Entity\PurchaseCheck", mappedBy="market", orphanRemoval=true)
     */
    private $checks;

    /**
     * @ORM\OneToMany(targetEntity="App\User\Entity\UserProduct", mappedBy="market")
     */
    private $userProducts;

    public function __construct()
    {
        $this->checks = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->userProducts = new ArrayCollection();
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

    /**
     * @return boolean
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getRelatedName(): ?string
    {
        return $this->relatedName;
    }

    public function setRelatedName(string $relatedName): self
    {
        $this->relatedName = $relatedName;

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

    /**
     * @return Collection|ParsingProduct[]
     */
    public function getMarketProducts(): Collection
    {
        return $this->marketProducts;
    }

    public function addMarketProduct(ParsingProduct $marketProduct): self
    {
        if (!$this->marketProducts->contains($marketProduct)) {
            $this->marketProducts[] = $marketProduct;
            $marketProduct->setMarket($this);
        }

        return $this;
    }

    public function removeMarketProduct(ParsingProduct $marketProduct): self
    {
        if ($this->marketProducts->contains($marketProduct)) {
            $this->marketProducts->removeElement($marketProduct);
            // set the owning side to null (unless already changed)
            if ($marketProduct->getMarket() === $this) {
                $marketProduct->setMarket(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PurchaseCheck[]
     */
    public function getChecks(): Collection
    {
        return $this->checks;
    }

    public function addCheck(PurchaseCheck $check): self
    {
        if (!$this->checks->contains($check)) {
            $this->checks[] = $check;
            $check->setMarket($this);
        }

        return $this;
    }

    public function removeCheck(PurchaseCheck $check): self
    {
        if ($this->checks->contains($check)) {
            $this->checks->removeElement($check);
            // set the owning side to null (unless already changed)
            if ($check->getMarket() === $this) {
                $check->setMarket(null);
            }
        }

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
     * @return Collection|UserProduct[]
     */
    public function getUserProducts(): Collection
    {
        return $this->userProducts;
    }

    public function addUserProduct(UserProduct $userProduct): self
    {
        if (!$this->userProducts->contains($userProduct)) {
            $this->userProducts[] = $userProduct;
            $userProduct->setMarket($this);
        }

        return $this;
    }

    public function removeUserProduct(UserProduct $userProduct): self
    {
        if ($this->userProducts->contains($userProduct)) {
            $this->userProducts->removeElement($userProduct);
            // set the owning side to null (unless already changed)
            if ($userProduct->getMarket() === $this) {
                $userProduct->setMarket(null);
            }
        }

        return $this;
    }
}
