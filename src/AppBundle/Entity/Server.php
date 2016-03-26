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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rack", inversedBy="servers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rack;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeServer")
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
     * @return integer
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
     * @return integer
     */
    public function getUsageCpu()
    {
        return $this->usageCpu;
    }

    /**
     * Set usageRam
     *
     * @param integer $usageRam
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
     * @return integer
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
     * @return integer
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
     * @return integer
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
     * @return integer
     */
    public function getUsageWan()
    {
        return $this->usageWan;
    }

    /**
     * Set rack
     *
     * @param \AppBundle\Entity\Rack $rack
     *
     * @return Server
     */
    public function setRack(\AppBundle\Entity\Rack $rack)
    {
        $this->rack = $rack;

        return $this;
    }

    /**
     * Get rack
     *
     * @return \AppBundle\Entity\Rack
     */
    public function getRack()
    {
        return $this->rack;
    }

    /**
     * Set typeServer
     *
     * @param \AppBundle\Entity\TypeServer $typeServer
     *
     * @return Server
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
}
