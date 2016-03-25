<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeElectricity
 *
 * @ORM\Table(name="type_electricity")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeElectricityRepository")
 */
class TypeElectricity
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
     * @ORM\Column(name="power", type="integer")
     */
    private $power;

    /**
     * @var int
     *
     * @ORM\Column(name="building_cost", type="integer")
     */
    private $buildingCost;

    /**
     * @var int
     *
     * @ORM\Column(name="monthly_cost", type="integer")
     */
    private $monthlyCost;

    /**
     * @var float
     *
     * @ORM\Column(name="kwh_cost", type="float")
     */
    private $kwhCost;


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
     * Set power
     *
     * @param integer $power
     *
     * @return TypeElectricity
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return int
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set buildingCost
     *
     * @param integer $buildingCost
     *
     * @return TypeElectricity
     */
    public function setBuildingCost($buildingCost)
    {
        $this->buildingCost = $buildingCost;

        return $this;
    }

    /**
     * Get buildingCost
     *
     * @return int
     */
    public function getBuildingCost()
    {
        return $this->buildingCost;
    }

    /**
     * Set monthlyCost
     *
     * @param integer $monthlyCost
     *
     * @return TypeElectricity
     */
    public function setMonthlyCost($monthlyCost)
    {
        $this->monthlyCost = $monthlyCost;

        return $this;
    }

    /**
     * Get monthlyCost
     *
     * @return int
     */
    public function getMonthlyCost()
    {
        return $this->monthlyCost;
    }

    /**
     * Set kwhCost
     *
     * @param float $kwhCost
     *
     * @return TypeElectricity
     */
    public function setKwhCost($kwhCost)
    {
        $this->kwhCost = $kwhCost;

        return $this;
    }

    /**
     * Get kwhCost
     *
     * @return float
     */
    public function getKwhCost()
    {
        return $this->kwhCost;
    }
}
