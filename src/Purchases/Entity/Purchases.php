<?php
declare(strict_types=1);

namespace App\Purchases\Entity;

use App\User\Entity\UserProduct;
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
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\User\Entity\User", inversedBy="purchases")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity="App\Purchases\Entity\PurchaseCheck", mappedBy="market", orphanRemoval=true)
     */
    private $checks;

    public function __construct()
    {
        $this->checks = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->userProducts = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\User\Entity\UserProduct", mappedBy="purchase", orphanRemoval=true)
     */
    private $userProducts;


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

    public function removeMarket(Markets $market): self
    {
        if ($this->markets->contains($market)) {
            $this->markets->removeElement($market);
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
            $check->setPurchase($this);
        }

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
            $userProduct->setPurchase($this);
        }

        return $this;
    }

    public function removeUserProduct(UserProduct $userProduct): self
    {
        if ($this->userProducts->contains($userProduct)) {
            $this->userProducts->removeElement($userProduct);
            // set the owning side to null (unless already changed)
            if ($userProduct->getPurchase() === $this) {
                $userProduct->setPurchase(null);
            }
        }

        return $this;
    }
}
