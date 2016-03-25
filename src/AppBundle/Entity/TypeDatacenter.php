<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeDatacenter
 *
 * @ORM\Table(name="type_datacenter")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeDatacenterRepository")
 */
class TypeDatacenter
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
     * @ORM\Column(name="max_rack", type="integer")
     */
    private $maxRack;


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
     * @return TypeDatacenter
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
     * Set maxRack
     *
     * @param integer $maxRack
     *
     * @return TypeDatacenter
     */
    public function setMaxRack($maxRack)
    {
        $this->maxRack = $maxRack;

        return $this;
    }

    /**
     * Get maxRack
     *
     * @return int
     */
    public function getMaxRack()
    {
        return $this->maxRack;
    }
}
