<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Suylom_kotoru
 *
 * @ORM\Table(name="suylom_kotoru")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\Suylom_kotoruRepository")
 */
class Suylom_kotoru
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
     * @ORM\Column(name="KSuy", type="string", length=255)
     */
    private $kSuy;

    /**
     * @var string
     *
     * @ORM\Column(name="OSuy", type="string", length=255)
     */
    private $oSuy;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="suylom_kotoru")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id" )
     */
    private $category;



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
     * Set kSuy
     *
     * @param string $kSuy
     * @return Suylom_kotoru
     */
    public function setKSuy($kSuy)
    {
        $this->kSuy = $kSuy;

        return $this;
    }

    /**
     * Get kSuy
     *
     * @return string 
     */
    public function getKSuy()
    {
        return $this->kSuy;
    }

    /**
     * Set oSuy
     *
     * @param string $oSuy
     * @return Suylom_kotoru
     */
    public function setOSuy($oSuy)
    {
        $this->oSuy = $oSuy;

        return $this;
    }

    /**
     * Get oSuy
     *
     * @return string 
     */
    public function getOSuy()
    {
        return $this->oSuy;
    }

    /**
     * Set category
     *
     * @param \MainBundle\Entity\Category $category
     * @return Suylom_kotoru
     */
    public function setCategory(\MainBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \MainBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
