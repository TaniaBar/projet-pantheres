<?php

namespace App\Entity;

use App\Repository\OrdersDetailsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrdersDetailsRepository::class)]
class OrdersDetails
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column]
    // private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[Assert\NotBlank()]
    #[Assert\PositiveOrZero()]
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\ManyToOne(inversedBy: 'ordersDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Orders $orders = null;

    #[ORM\ManyToOne(inversedBy: 'ordersDetails')]
    private ?Wines $wines = null;

    #[ORM\ManyToOne(inversedBy: 'ordersDetails')]
    private ?Boxes $boxes = null;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getOrders(): ?Orders
    {
        return $this->orders;
    }

    public function setOrders(?Orders $orders): static
    {
        $this->orders = $orders;

        return $this;
    }

    public function getWines(): ?Wines
    {
        return $this->wines;
    }

    public function setWines(?Wines $wines): static
    {
        $this->wines = $wines;

        return $this;
    }

    public function getBoxes(): ?Boxes
    {
        return $this->boxes;
    }

    public function setBoxes(?Boxes $boxes): static
    {
        $this->boxes = $boxes;

        return $this;
    }
}
