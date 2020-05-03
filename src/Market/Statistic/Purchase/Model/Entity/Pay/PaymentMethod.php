<?php

namespace App\Market\Purchases\Model\Entity;

use App\User\Entity\UserProduct;
use App\Purchases\Entity\CreditCard;
use App\Purchases\Entity\PurchaseCheck;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Purchases\Repository\PurchaseCheckRepository")
 */
class PaymentMethod
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
    private $method;

    /**
     * @ORM\OneToMany(targetEntity="App\Purchases\Entity\PurchaseCheck", mappedBy="paymentMethod", orphanRemoval=true)
     */
    private $checks;

    /**
     * @ORM\OneToMany(targetEntity="App\Purchases\Entity\CreditCard", mappedBy="paymentMethod", orphanRemoval=true)
     */
    private $creditCards;

    /**
     * @ORM\OneToMany(targetEntity="App\User\Entity\UserProduct", mappedBy="paymentMethod", orphanRemoval=true)
     */
    private $userProducts;

    public function __construct()
    {
        $this->checks = new ArrayCollection();
        $this->creditCards = new ArrayCollection();
        $this->userProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return Collection|Receipt[]
     */
    public function getChecks(): Collection
    {
        return $this->checks;
    }

    public function addCheck(PurchaseCheck $check): self
    {
        if (!$this->checks->contains($check)) {
            $this->checks[] = $check;
            $check->setPaymentMethod($this);
        }

        return $this;
    }

    public function removeCheck(PurchaseCheck $check): self
    {
        if ($this->checks->contains($check)) {
            $this->checks->removeElement($check);
            // set the owning side to null (unless already changed)
            if ($check->getPaymentMethod() === $this) {
                $check->setPaymentMethod(null);
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
            $creditCard->setPaymentMethod($this);
        }

        return $this;
    }

    public function removeCreditCard(CreditCard $creditCard): self
    {
        if ($this->creditCards->contains($creditCard)) {
            $this->creditCards->removeElement($creditCard);
            // set the owning side to null (unless already changed)
            if ($creditCard->getPaymentMethod() === $this) {
                $creditCard->setPaymentMethod(null);
            }
        }

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
            $userProduct->setPaymentMethod($this);
        }

        return $this;
    }

    public function removeUserProduct(UserProduct $userProduct): self
    {
        if ($this->userProducts->contains($userProduct)) {
            $this->userProducts->removeElement($userProduct);
            // set the owning side to null (unless already changed)
            if ($userProduct->getPaymentMethod() === $this) {
                $userProduct->setPaymentMethod(null);
            }
        }

        return $this;
    }
}
