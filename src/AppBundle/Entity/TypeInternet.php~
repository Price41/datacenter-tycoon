<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeInternet
 *
 * @ORM\Table(name="type_internet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeInternetRepository")
 */
class TypeInternet
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
     * @ORM\Column(name="speed", type="integer")
     */
    private $speed;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set speed
     *
     * @param integer $speed
     *
     * @return TypeInternet
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return int
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set buildingCost
     *
     * @param integer $buildingCost
     *
     * @return TypeInternet
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
     * @return TypeInternet
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
}
