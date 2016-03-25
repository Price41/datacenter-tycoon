<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var int
     *
     * @ORM\Column(name="player", type="integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @var int
     *
     * @ORM\Column(name="type_datacenter", type="integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeDatacenter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeDatacenter;

    /**
     * @var int
     *
     * @ORM\Column(name="type_electricity", type="integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeElectricity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeElectricity;

    /**
     * @var int
     *
     * @ORM\Column(name="type_internet", type="integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeInternet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeInternet;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set player
     *
     * @param integer $player
     *
     * @return Datacenter
     */
    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return int
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set typeDatacenter
     *
     * @param integer $typeDatacenter
     *
     * @return Datacenter
     */
    public function setTypeDatacenter($typeDatacenter)
    {
        $this->typeDatacenter = $typeDatacenter;

        return $this;
    }

    /**
     * Get typeDatacenter
     *
     * @return int
     */
    public function getTypeDatacenter()
    {
        return $this->typeDatacenter;
    }

    /**
     * Set typeElectricity
     *
     * @param integer $typeElectricity
     *
     * @return Datacenter
     */
    public function setTypeElectricity($typeElectricity)
    {
        $this->typeElectricity = $typeElectricity;

        return $this;
    }

    /**
     * Get typeElectricity
     *
     * @return int
     */
    public function getTypeElectricity()
    {
        return $this->typeElectricity;
    }

    /**
     * Set typeInternet
     *
     * @param integer $typeInternet
     *
     * @return Datacenter
     */
    public function setTypeInternet($typeInternet)
    {
        $this->typeInternet = $typeInternet;

        return $this;
    }

    /**
     * Get typeInternet
     *
     * @return int
     */
    public function getTypeInternet()
    {
        return $this->typeInternet;
    }
}
