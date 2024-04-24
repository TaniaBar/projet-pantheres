<?php

namespace App\Entity;

use App\Repository\WinesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: WinesRepository::class)]
class Wines
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Assert\NotBlank()]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[Assert\NotBlank()]
    #[Assert\PositiveOrZero()]
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[Assert\NotBlank()]
    #[Assert\PositiveOrZero()]
    #[ORM\Column]
    private ?int $stock = null;

    #[Assert\NotBlank()]
    #[ORM\Column(length: 255)]
    private ?string $origin = null;

    #[Assert\NotBlank()]
    #[ORM\Column(length: 255)]
    private ?string $variety = null;

    #[Assert\NotBlank()]
    #[ORM\Column(length: 255)]
    private ?string $accords = null;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'wines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $categories = null;

    /**
     * @var Collection<int, Images>
     */
    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'wines', orphanRemoval: true)]
    private Collection $images;

    /**
     * @var Collection<int, OrdersDetails>
     */
    #[ORM\OneToMany(targetEntity: OrdersDetails::class, mappedBy: 'wines')]
    private Collection $ordersDetails;

    #[ORM\ManyToOne(inversedBy: 'wines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Suppliers $suppliers = null;

    public function __toString(): string
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->ordersDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): static
    {
        $this->origin = $origin;

        return $this;
    }

    public function getVariety(): ?string
    {
        return $this->variety;
    }

    public function setVariety(string $variety): static
    {
        $this->variety = $variety;

        return $this;
    }

    public function getAccords(): ?string
    {
        return $this->accords;
    }

    public function setAccords(string $accords): static
    {
        $this->accords = $accords;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): static
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setWines($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getWines() === $this) {
                $image->setWines(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrdersDetails>
     */
    public function getOrdersDetails(): Collection
    {
        return $this->ordersDetails;
    }

    public function addOrdersDetail(OrdersDetails $ordersDetail): static
    {
        if (!$this->ordersDetails->contains($ordersDetail)) {
            $this->ordersDetails->add($ordersDetail);
            $ordersDetail->setWines($this);
        }

        return $this;
    }

    public function removeOrdersDetail(OrdersDetails $ordersDetail): static
    {
        if ($this->ordersDetails->removeElement($ordersDetail)) {
            // set the owning side to null (unless already changed)
            if ($ordersDetail->getWines() === $this) {
                $ordersDetail->setWines(null);
            }
        }

        return $this;
    }

    public function getSuppliers(): ?Suppliers
    {
        return $this->suppliers;
    }

    public function setSuppliers(?Suppliers $suppliers): static
    {
        $this->suppliers = $suppliers;

        return $this;
    }
}
