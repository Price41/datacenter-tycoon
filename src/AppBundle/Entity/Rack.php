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
     * @var int
     *
     * @ORM\Column(name="datacenter", type="integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Datacenter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $datacenter;


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
     * Set datacenter
     *
     * @param integer $datacenter
     *
     * @return Rack
     */
    public function setDatacenter($datacenter)
    {
        $this->datacenter = $datacenter;

        return $this;
    }

    /**
     * Get datacenter
     *
     * @return integer
     */
    public function getDatacenter()
    {
        return $this->datacenter;
    }
}
