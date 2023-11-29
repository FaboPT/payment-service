<?php

namespace App\Entity;

use App\emuns\PaymentMethodType;
use App\Repository\PaymentMethodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentMethodRepository::class)]
class PaymentMethod
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $deliveryCost = null;

    #[ORM\Column]
    private ?float $transferCost = null;

    #[ORM\Column(length: 255)]
    private ?string $redirectUrl = null;

    #[ORM\OneToMany(mappedBy: 'paymentMethod', targetEntity: Payment::class)]
    private Collection $payments;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $hashedUsername = null;

    #[ORM\Column(type: 'string', enumType: PaymentMethodType::class )]
    private PaymentMethodType $paymentMethodType;

    public function __construct()
    {
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliveryCost(): ?float
    {
        return $this->deliveryCost;
    }

    public function setDeliveryCost(float $deliveryCost): static
    {
        $this->deliveryCost = $deliveryCost;

        return $this;
    }

    public function getTransferCost(): ?float
    {
        return $this->transferCost;
    }

    public function setTransferCost(float $transferCost): static
    {
        $this->transferCost = $transferCost;

        return $this;
    }

    public function getRedirectUrl(): ?string
    {
        return $this->redirectUrl;
    }

    public function setRedirectUrl(string $redirectUrl): static
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }

    /**
     * @return Collection<int, Payment>
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): static
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setPaymentMethod($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): static
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getPaymentMethod() === $this) {
                $payment->setPaymentMethod(null);
            }
        }

        return $this;
    }

    public function getHashedUsername(): ?string
    {
        return $this->hashedUsername;
    }

    public function setHashedUsername(?string $hashedUsername): self
    {
        $this->hashedUsername = $hashedUsername;

        return this;
    }

    public function getPaymentMethodType(): PaymentMethodType
    {
        return $this->paymentMethodType;
    }

    public function setPaymentMethodType(PaymentMethodType $paymentMethodType): self
    {
        $this->paymentMethodType = $paymentMethodType;

        return $this;
    }
}
