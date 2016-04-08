<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Datacenter
 *
 * @ORM\Table(name="datacenter")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DatacenterRepository")
 */
class Datacenter
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="datacenters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeDatacenter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeDatacenter;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeElectricity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeElectricity;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeInternet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeInternet;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rack", mappedBy="datacenter")
     */
    private $racks;


    public function __construct()
    {
        $this->racks = new ArrayCollection();
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
     * Set player
     *
     * @param \AppBundle\Entity\User $player
     *
     * @return Datacenter
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

    /**
     * Set typeDatacenter
     *
     * @param \AppBundle\Entity\TypeDatacenter $typeDatacenter
     *
     * @return Datacenter
     */
    public function setTypeDatacenter(\AppBundle\Entity\TypeDatacenter $typeDatacenter)
    {
        $this->typeDatacenter = $typeDatacenter;

        return $this;
    }

    /**
     * Get typeDatacenter
     *
     * @return \AppBundle\Entity\TypeDatacenter
     */
    public function getTypeDatacenter()
    {
        return $this->typeDatacenter;
    }

    /**
     * Set typeElectricity
     *
     * @param \AppBundle\Entity\TypeElectricity $typeElectricity
     *
     * @return Datacenter
     */
    public function setTypeElectricity(\AppBundle\Entity\TypeElectricity $typeElectricity)
    {
        $this->typeElectricity = $typeElectricity;

        return $this;
    }

    /**
     * Get typeElectricity
     *
     * @return \AppBundle\Entity\TypeElectricity
     */
    public function getTypeElectricity()
    {
        return $this->typeElectricity;
    }

    /**
     * Set typeInternet
     *
     * @param \AppBundle\Entity\TypeInternet $typeInternet
     *
     * @return Datacenter
     */
    public function setTypeInternet(\AppBundle\Entity\TypeInternet $typeInternet)
    {
        $this->typeInternet = $typeInternet;

        return $this;
    }

    /**
     * Get typeInternet
     *
     * @return \AppBundle\Entity\TypeInternet
     */
    public function getTypeInternet()
    {
        return $this->typeInternet;
    }

    public function addRack(Rack $rack)
    {
        $this->racks[] = $rack;

        return $this;
    }

    public function removeRack(Rack $rack)
    {
        $this->racks->removeElement($rack);
    }

    public function getRacks()
    {
        return $this->racks;
    }
}
