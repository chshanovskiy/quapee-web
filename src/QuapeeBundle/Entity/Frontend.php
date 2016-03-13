<?php

namespace QuapeeBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Frontend
 *
 * @ORM\Table(name="frontend")
 * @ORM\Entity(repositoryClass="QuapeeBundle\Repository\FrontendRepository")
 */
class Frontend
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \QuapeeBundle\Entity\Service[]
     *
     * @ORM\ManyToMany(targetEntity="QuapeeBundle\Entity\Service")
     */
    private $services;

    public function __construct()
    {
        $this->services = new ArrayCollection();
    }

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
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Frontend
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Frontend
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return \QuapeeBundle\Entity\Service[]
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param \QuapeeBundle\Entity\Service[] $services
     */
    public function setServices($services)
    {
        $this->services = $services;
    }

}

