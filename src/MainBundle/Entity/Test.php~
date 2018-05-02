<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\TestRepository")
 */
class Test
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
     * @ORM\Column(name="sozV1", type="string", length=255)
     */
    private $sozV1;

    /**
     * @var string
     *
     * @ORM\Column(name="sozV2", type="string", length=255)
     */
    private $sozV2;

    /**
     * @var string
     *
     * @ORM\Column(name="sozV3", type="string", length=255)
     */
    private $sozV3;
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="test")
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
     * @return Test
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
     * Set sozV1
     *
     * @param string $sozV1
     * @return Test
     */
    public function setSozV1($sozV1)
    {
        $this->sozV1 = $sozV1;

        return $this;
    }

    /**
     * Get sozV1
     *
     * @return string 
     */
    public function getSozV1()
    {
        return $this->sozV1;
    }

    /**
     * Set sozV2
     *
     * @param string $sozV2
     * @return Test
     */
    public function setSozV2($sozV2)
    {
        $this->sozV2 = $sozV2;

        return $this;
    }

    /**
     * Get sozV2
     *
     * @return string 
     */
    public function getSozV2()
    {
        return $this->sozV2;
    }

    /**
     * Set sozV3
     *
     * @param string $sozV3
     * @return Test
     */
    public function setSozV3($sozV3)
    {
        $this->sozV3 = $sozV3;

        return $this;
    }

    /**
     * Get sozV3
     *
     * @return string 
     */
    public function getSozV3()
    {
        return $this->sozV3;
    }

    /**
     * Set category
     *
     * @param \MainBundle\Entity\Category $category
     * @return Test
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
