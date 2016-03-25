<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Server
 *
 * @ORM\Table(name="server")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServerRepository")
 */
class Server
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
     * @ORM\Column(name="id_rack", type="integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rack")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rack;

    /**
     * @var int
     *
     * @ORM\Column(name="id_type_server", type="integer")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\TypeServer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeServer;

    /**
     * @var int
     *
     * @ORM\Column(name="usage_cpu", type="integer")
     */
    private $usageCpu;

    /**
     * @var int
     *
     * @ORM\Column(name="usage_ram", type="integer")
     */
    private $usageRam;

    /**
     * @var int
     *
     * @ORM\Column(name="usage_hdd", type="integer")
     */
    private $usageHdd;

    /**
     * @var int
     *
     * @ORM\Column(name="usage_lan", type="integer")
     */
    private $usageLan;

    /**
     * @var int
     *
     * @ORM\Column(name="usage_wan", type="integer")
     */
    private $usageWan;


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
     * Set usageCpu
     *
     * @param integer $usageCpu
     *
     * @return Server
     */
    public function setUsageCpu($usageCpu)
    {
        $this->usageCpu = $usageCpu;

        return $this;
    }

    /**
     * Get usageCpu
     *
     * @return int
     */
    public function getUsageCpu()
    {
        return $this->usageCpu;
    }

    /**
     * Set usageRam
     *
     * @param int $usageRam
     *
     * @return Server
     */
    public function setUsageRam($usageRam)
    {
        $this->usageRam = $usageRam;

        return $this;
    }

    /**
     * Get usageRam
     *
     * @return int
     */
    public function getUsageRam()
    {
        return $this->usageRam;
    }

    /**
     * Set usageHdd
     *
     * @param integer $usageHdd
     *
     * @return Server
     */
    public function setUsageHdd($usageHdd)
    {
        $this->usageHdd = $usageHdd;

        return $this;
    }

    /**
     * Get usageHdd
     *
     * @return int
     */
    public function getUsageHdd()
    {
        return $this->usageHdd;
    }

    /**
     * Set usageLan
     *
     * @param integer $usageLan
     *
     * @return Server
     */
    public function setUsageLan($usageLan)
    {
        $this->usageLan = $usageLan;

        return $this;
    }

    /**
     * Get usageLan
     *
     * @return int
     */
    public function getUsageLan()
    {
        return $this->usageLan;
    }

    /**
     * Set usageWan
     *
     * @param integer $usageWan
     *
     * @return Server
     */
    public function setUsageWan($usageWan)
    {
        $this->usageWan = $usageWan;

        return $this;
    }

    /**
     * Get usageWan
     *
     * @return int
     */
    public function getUsageWan()
    {
        return $this->usageWan;
    }

    /**
     * Set rack
     *
     * @param integer $rack
     *
     * @return Server
     */
    public function setRack($rack)
    {
        $this->rack = $rack;

        return $this;
    }

    /**
     * Get rack
     *
     * @return integer
     */
    public function getRack()
    {
        return $this->rack;
    }

    /**
     * Set typeServer
     *
     * @param integer $typeServer
     *
     * @return Server
     */
    public function setTypeServer($typeServer)
    {
        $this->typeServer = $typeServer;

        return $this;
    }

    /**
     * Get typeServer
     *
     * @return integer
     */
    public function getTypeServer()
    {
        return $this->typeServer;
    }
}
