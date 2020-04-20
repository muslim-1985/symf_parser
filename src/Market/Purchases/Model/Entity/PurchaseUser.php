<?php
declare(strict_types=1);

namespace App\Market\Purchases\Model\Entity;

use App\Purchases\Entity\CreditCard;
use App\Purchases\Entity\Purchases;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="user_purchases")
 * @ORM\Entity(repositoryClass="App\User\Repository\UserRepository")
 * @UniqueEntity("email")
 */
class PurchaseUser
{
    /**
     * @ORM\Column(type="user_purchase_id")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Purchases\Entity\Purchases", mappedBy="owner", orphanRemoval=true)
     */
    private $purchases;

    /**
     * @ORM\OneToMany(targetEntity="App\Purchases\Entity\CreditCard", mappedBy="owner", orphanRemoval=true)
     */
    private $creditCards;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        $this->purchases = new ArrayCollection();
        $this->creditCards = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Purchases[]
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Purchases $purchase): self
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases[] = $purchase;
            $purchase->setOwner($this);
        }

        return $this;
    }

    public function removePurchase(Purchases $purchase): self
    {
        if ($this->purchases->contains($purchase)) {
            $this->purchases->removeElement($purchase);
            // set the owning side to null (unless already changed)
            if ($purchase->getOwner() === $this) {
                $purchase->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CreditCard[]
     */
    public function getCreditCards(): Collection
    {
        return $this->creditCards;
    }

    public function addCreditCard(CreditCard $creditCard): self
    {
        if (!$this->creditCards->contains($creditCard)) {
            $this->creditCards[] = $creditCard;
            $creditCard->setOwner($this);
        }

        return $this;
    }

    public function removeCreditCard(CreditCard $creditCard): self
    {
        if ($this->creditCards->contains($creditCard)) {
            $this->creditCards->removeElement($creditCard);
            // set the owning side to null (unless already changed)
            if ($creditCard->getOwner() === $this) {
                $creditCard->setOwner(null);
            }
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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}