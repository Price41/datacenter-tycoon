<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerRepository")
 */
class Customer
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Offer", inversedBy="customers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offer;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="subscription_date", type="datetime")
     */
    private $subscriptionDate;

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
     * Set name
     *
     * @param string $name
     *
     * @return Customer
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Customer
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set subscriptionDate
     *
     * @param DateTime $subscriptionDate
     *
     * @return Customer
     */
    public function setSubscriptionDate($subscriptionDate)
    {
        $this->subscriptionDate = $subscriptionDate;

        return $this;
    }

    /**
     * Get subscriptionDate
     *
     * @return DateTime
     */
    public function getSubscriptionDate()
    {
        return $this->subscriptionDate;
    }

    /**
     * Set offer
     *
     * @param \AppBundle\Entity\Offer $offer
     *
     * @return Customer
     */
    public function setOffer(\AppBundle\Entity\Offer $offer)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return \AppBundle\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }
}
