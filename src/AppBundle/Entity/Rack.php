<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rack
 *
 * @ORM\Table(name="rack")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RackRepository")
 */
class Rack
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Datacenter", inversedBy="racks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $datacenter;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Server", mappedBy="rack")
     */
    private $servers;


    public function __construct()
    {
        $this->servers = new ArrayCollection();
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
     * Set datacenter
     *
     * @param \AppBundle\Entity\Datacenter $datacenter
     *
     * @return Rack
     */
    public function setDatacenter(\AppBundle\Entity\Datacenter $datacenter)
    {
        $this->datacenter = $datacenter;

        return $this;
    }

    /**
     * Get datacenter
     *
     * @return \AppBundle\Entity\Datacenter
     */
    public function getDatacenter()
    {
        return $this->datacenter;
    }

    public function addServer(Server $server)
    {
        $this->servers[] = $server;

        return $this;
    }

    public function removeServer(Server $server)
    {
        $this->servers->removeElement($server);
    }

    public function getServers()
    {
        return $this->servers;
    }
}
