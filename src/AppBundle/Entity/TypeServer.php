<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeServer
 *
 * @ORM\Table(name="type_server")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeServerRepository")
 */
class TypeServer
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="cpu_number", type="integer")
     */
    private $cpuNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="cpu_cores", type="integer")
     */
    private $cpuCores;

    /**
     * @var int
     *
     * @ORM\Column(name="cpu_HT", type="integer")
     */
    private $cpuHT;

    /**
     * @var int
     *
     * @ORM\Column(name="cpu_freq", type="integer")
     */
    private $cpuFreq;

    /**
     * @var int
     *
     * @ORM\Column(name="ram", type="integer")
     */
    private $ram;

    /**
     * @var int
     *
     * @ORM\Column(name="hdd", type="integer")
     */
    private $hdd;

    /**
     * @var int
     *
     * @ORM\Column(name="consumption", type="integer")
     */
    private $consumption;

    /**
     * @var int
     *
     * @ORM\Column(name="buying_cost", type="integer")
     */
    private $buyingCost;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer")
     */
    private $height;


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
     * Set name
     *
     * @param string $name
     *
     * @return TypeServer
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
     * Set cpuNumber
     *
     * @param integer $cpuNumber
     *
     * @return TypeServer
     */
    public function setCpuNumber($cpuNumber)
    {
        $this->cpuNumber = $cpuNumber;

        return $this;
    }

    /**
     * Get cpuNumber
     *
     * @return int
     */
    public function getCpuNumber()
    {
        return $this->cpuNumber;
    }

    /**
     * Set cpuCores
     *
     * @param integer $cpuCores
     *
     * @return TypeServer
     */
    public function setCpuCores($cpuCores)
    {
        $this->cpuCores = $cpuCores;

        return $this;
    }

    /**
     * Get cpuCores
     *
     * @return int
     */
    public function getCpuCores()
    {
        return $this->cpuCores;
    }

    /**
     * Set cpuHT
     *
     * @param integer $cpuHT
     *
     * @return TypeServer
     */
    public function setCpuHT($cpuHT)
    {
        $this->cpuHT = $cpuHT;

        return $this;
    }

    /**
     * Get cpuHT
     *
     * @return int
     */
    public function getCpuHT()
    {
        return $this->cpuHT;
    }

    /**
     * Set cpuFreq
     *
     * @param integer $cpuFreq
     *
     * @return TypeServer
     */
    public function setCpuFreq($cpuFreq)
    {
        $this->cpuFreq = $cpuFreq;

        return $this;
    }

    /**
     * Get cpuFreq
     *
     * @return int
     */
    public function getCpuFreq()
    {
        return $this->cpuFreq;
    }

    /**
     * Set ram
     *
     * @param integer $ram
     *
     * @return TypeServer
     */
    public function setRam($ram)
    {
        $this->ram = $ram;

        return $this;
    }

    /**
     * Get ram
     *
     * @return int
     */
    public function getRam()
    {
        return $this->ram;
    }

    /**
     * Set hdd
     *
     * @param integer $hdd
     *
     * @return TypeServer
     */
    public function setHdd($hdd)
    {
        $this->hdd = $hdd;

        return $this;
    }

    /**
     * Get hdd
     *
     * @return int
     */
    public function getHdd()
    {
        return $this->hdd;
    }

    /**
     * Set consumption
     *
     * @param integer $consumption
     *
     * @return TypeServer
     */
    public function setConsumption($consumption)
    {
        $this->consumption = $consumption;

        return $this;
    }

    /**
     * Get consumption
     *
     * @return int
     */
    public function getConsumption()
    {
        return $this->consumption;
    }

    /**
     * Set buyingCost
     *
     * @param integer $buyingCost
     *
     * @return TypeServer
     */
    public function setBuyingCost($buyingCost)
    {
        $this->buyingCost = $buyingCost;

        return $this;
    }

    /**
     * Get buyingCost
     *
     * @return int
     */
    public function getBuyingCost()
    {
        return $this->buyingCost;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return TypeServer
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }
}
