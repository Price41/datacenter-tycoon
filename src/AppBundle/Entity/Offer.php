<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfferRepository")
 */
class Offer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeServer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeServer;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Customer", mappedBy="offer")
     */
    private $customers;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set typeServer
     *
     * @param \AppBundle\Entity\TypeServer $typeServer
     *
     * @return Offer
     */
    public function setTypeServer(\AppBundle\Entity\TypeServer $typeServer)
    {
        $this->typeServer = $typeServer;

        return $this;
    }

    /**
     * Get typeServer
     *
     * @return \AppBundle\Entity\TypeServer
     */
    public function getTypeServer()
    {
        return $this->typeServer;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Offer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Offer
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set player
     *
     * @param \AppBundle\Entity\User $player
     *
     * @return Offer
     */
    public function setPlayer(\AppBundle\Entity\User $player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \AppBundle\Entity\User
     */
    public function getPlayer()
    {
        return $this->player;
    }

    public function addCustomer(Customer $customer)
    {
        $this->customers[] = $customer;

        return $this;
    }

    public function removeCustomer(Customer $customer)
    {
        $this->customers->removeElement($customer);
    }

    public function getCustomers()
    {
        return $this->customers;
    }
}
