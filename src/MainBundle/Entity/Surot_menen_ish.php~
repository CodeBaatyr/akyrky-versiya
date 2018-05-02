<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * Surot_menen_ish
 *
 * @ORM\Table(name="surot_menen_ish")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\Surot_menen_ishRepository")
 *
 */

class Surot_menen_ish
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
     * @ORM\Column(name="OSoz", type="string", length=255, unique=true)
     */
    private $oSoz;
    public function __toString()
    {
        return $this->getOSoz();
    }


    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="surot_menen_ish")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id" )
     */
    private $category;
    /**
     * @var string
     *
     * @ORM\Column(name="kst", type="string", length=255)
     */
    private $kst;
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="KSTimg_id", referencedColumnName="id")
     * })
     */
    private $KSTimg;


    /**
     * @var string
     *
     * @ORM\Column(name="KSV1", type="string", length=255)
     */
    private $kSV1;
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="KSV1img_id", referencedColumnName="id")
     * })
     */
    private $KSV1img;

    /**
     * @var string
     *
     * @ORM\Column(name="KSV2", type="string", length=255)
     */
    private $kSV2;
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="KSV2img_id", referencedColumnName="id")
     * })
     */
    private $KSV2img;








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
     * Set oSoz
     *
     * @param string $oSoz
     * @return Surot_menen_ish
     */
    public function setOSoz($oSoz)
    {
        $this->oSoz = $oSoz;

        return $this;
    }

    /**
     * Get oSoz
     *
     * @return string 
     */
    public function getOSoz()
    {
        return $this->oSoz;
    }





    /**
     * Set kst
     *
     * @param string $kst
     * @return Surot_menen_ish
     */
    public function setKst($kst)
    {
        $this->kst = $kst;

        return $this;
    }

    /**
     * Get kst
     *
     * @return string 
     */
    public function getKst()
    {
        return $this->kst;
    }

    /**
     * Set kSV1
     *
     * @param string $kSV1
     * @return Surot_menen_ish
     */
    public function setKSV1($kSV1)
    {
        $this->kSV1 = $kSV1;

        return $this;
    }

    /**
     * Get kSV1
     *
     * @return string 
     */
    public function getKSV1()
    {
        return $this->kSV1;
    }

    /**
     * Set kSV2
     *
     * @param string $kSV2
     * @return Surot_menen_ish
     */
    public function setKSV2($kSV2)
    {
        $this->kSV2 = $kSV2;

        return $this;
    }

    /**
     * Get kSV2
     *
     * @return string 
     */
    public function getKSV2()
    {
        return $this->kSV2;
    }

    /**
     * Set category
     *
     * @param \MainBundle\Entity\Category $category
     * @return Surot_menen_ish
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

    /**
     * Set KSV1img
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $kSV1img
     * @return Surot_menen_ish
     */
    public function setKSV1img(\Application\Sonata\MediaBundle\Entity\Media $kSV1img = null)
    {
        $this->KSV1img = $kSV1img;

        return $this;
    }

    /**
     * Get KSV1img
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getKSV1img()
    {
        return $this->KSV1img;
    }

    /**
     * Set KSV2img
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $kSV2img
     * @return Surot_menen_ish
     */
    public function setKSV2img(\Application\Sonata\MediaBundle\Entity\Media $kSV2img = null)
    {
        $this->KSV2img = $kSV2img;

        return $this;
    }

    /**
     * Get KSV2img
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getKSV2img()
    {
        return $this->KSV2img;
    }

    /**
     * Set KSTimg
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $kSTimg
     * @return Surot_menen_ish
     */
    public function setKSTimg(\Application\Sonata\MediaBundle\Entity\Media $kSTimg = null)
    {
        $this->KSTimg = $kSTimg;

        return $this;
    }

    /**
     * Get KSTimg
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getKSTimg()
    {
        return $this->KSTimg;
    }
}
