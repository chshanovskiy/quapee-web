<?php

namespace QuapeeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Alias
 *
 * @ORM\Table(name="alias")
 * @ORM\Entity(repositoryClass="QuapeeBundle\Repository\AliasRepository")
 */
class Alias
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
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="uri", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $uri;

    /**
     * @var string
     *
     * @ORM\Column(name="created_by", type="string", length=255, nullable=true)
     */
    private $createdBy;

    /**
     * @var \QuapeeBundle\Entity\Frontend
     *
     * @ORM\ManyToOne(targetEntity="QuapeeBundle\Entity\Frontend")
     * @Assert\NotBlank()
     */
    private $frontend;

    /**
     * @var \QuapeeBundle\Entity\Credential
     *
     * @ORM\ManyToOne(targetEntity="QuapeeBundle\Entity\Credential")
     * @Assert\NotBlank()
     */
    private $credential;


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
     * @return Alias
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set uri
     *
     * @param string $uri
     *
     * @return Alias
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     *
     * @return Alias
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Frontend
     */
    public function getFrontend()
    {
        return $this->frontend;
    }

    /**
     * @param Frontend $frontend
     */
    public function setFrontend($frontend)
    {
        $this->frontend = $frontend;
    }

    /**
     * @return Credential
     */
    public function getCredential()
    {
        return $this->credential;
    }

    /**
     * @param Credential $credential
     */
    public function setCredential($credential)
    {
        $this->credential = $credential;
    }
}

