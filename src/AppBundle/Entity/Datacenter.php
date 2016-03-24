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
     */
    private $player;

    /**
     * @var int
     *
     * @ORM\Column(name="typeDatacenter", type="integer")
     */
    private $typeDatacenter;

    /**
     * @var int
     *
     * @ORM\Column(name="typeElectricity", type="integer")
     */
    private $typeElectricity;

    /**
     * @var int
     *
     * @ORM\Column(name="typeInternet", type="integer")
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

