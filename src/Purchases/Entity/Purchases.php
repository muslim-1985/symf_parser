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
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;


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
}
