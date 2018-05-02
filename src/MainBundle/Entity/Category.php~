<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;
    public function __toString()
    {
        return $this->getName();
    }
    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=255, unique=true)
     */
    private $position;

    /**
     * @ORM\OneToMany(targetEntity="Surot_menen_ish", mappedBy="category",cascade={"all"})
     */
    private $surot_menen_ish;

    /**
     * @ORM\OneToMany(targetEntity="Suylom_kotoru", mappedBy="category",cascade={"all"})
     */
    private $suylom_kotoru;


    /**
     * @ORM\OneToMany(targetEntity="Test", mappedBy="category",cascade={"all"})
     */
    private $test;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="imgAktive_id", referencedColumnName="id")
     * })
     */
    private $imgAktive;
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="imgPassive_id", referencedColumnName="id")
     * })
     */
    private $imgPassive;




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
     * Set name
     *
     * @param string $name
     * @return Category
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
     * Add surot_menen_ish
     *
     * @param \MainBundle\Entity\Surot_menen_ish $surotMenenIsh
     * @return Category
     */
    public function addSurotMenenIsh(\MainBundle\Entity\Surot_menen_ish $surotMenenIsh)
    {
        $this->surot_menen_ish[] = $surotMenenIsh;

        return $this;
    }

    /**
     * Remove surot_menen_ish
     *
     * @param \MainBundle\Entity\Surot_menen_ish $surotMenenIsh
     */
    public function removeSurotMenenIsh(\MainBundle\Entity\Surot_menen_ish $surotMenenIsh)
    {
        $this->surot_menen_ish->removeElement($surotMenenIsh);
    }

    /**
     * Get surot_menen_ish
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSurotMenenIsh()
    {
        return $this->surot_menen_ish;
    }

    /**
     * Add suylom_kotoru
     *
     * @param \MainBundle\Entity\Suylom_kotoru $suylomKotoru
     * @return Category
     */
    public function addSuylomKotoru(\MainBundle\Entity\Suylom_kotoru $suylomKotoru)
    {
        $this->suylom_kotoru[] = $suylomKotoru;

        return $this;
    }

    /**
     * Remove suylom_kotoru
     *
     * @param \MainBundle\Entity\Suylom_kotoru $suylomKotoru
     */
    public function removeSuylomKotoru(\MainBundle\Entity\Suylom_kotoru $suylomKotoru)
    {
        $this->suylom_kotoru->removeElement($suylomKotoru);
    }

    /**
     * Get suylom_kotoru
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSuylomKotoru()
    {
        return $this->suylom_kotoru;
    }

    /**
     * Add test
     *
     * @param \MainBundle\Entity\Test $test
     * @return Category
     */
    public function addTest(\MainBundle\Entity\Test $test)
    {
        $this->test[] = $test;

        return $this;
    }

    /**
     * Remove test
     *
     * @param \MainBundle\Entity\Test $test
     */
    public function removeTest(\MainBundle\Entity\Test $test)
    {
        $this->test->removeElement($test);
    }

    /**
     * Get test
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->surot_menen_ish = new \Doctrine\Common\Collections\ArrayCollection();
        $this->suylom_kotoru = new \Doctrine\Common\Collections\ArrayCollection();
        $this->test = new \Doctrine\Common\Collections\ArrayCollection();

    }



    /**
     * Set imgAktive
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $imgAktive
     * @return Category
     */
    public function setImgAktive(\Application\Sonata\MediaBundle\Entity\Media $imgAktive = null)
    {
        $this->imgAktive = $imgAktive;

        return $this;
    }

    /**
     * Get imgAktive
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getImgAktive()
    {
        return $this->imgAktive;
    }

    /**
     * Set imgPassive
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $imgPassive
     * @return Category
     */
    public function setImgPassive(\Application\Sonata\MediaBundle\Entity\Media $imgPassive = null)
    {
        $this->imgPassive = $imgPassive;

        return $this;
    }

    /**
     * Get imgPassive
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getImgPassive()
    {
        return $this->imgPassive;
    }



    /**
     * Set position
     *
     * @param string $position
     * @return Category
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }
}
