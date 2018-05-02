<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TextTranslate
 *
 * @ORM\Table(name="text_translate")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\TextTranslateRepository")
 */
class TextTranslate
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
     * @ORM\Column(name="ru", type="text", nullable=true)
     */
    private $ru;

    /**
     * @var string
     *
     * @ORM\Column(name="en", type="text", nullable=true)
     */
    private $en;

    /**
     * @var string
     *
     * @ORM\Column(name="ky", type="text", nullable=true)
     */
    private $ky;


    /**
     * @var string
     *
     * @ORM\Column(name="attribute", type="string", length=255)
     */
    private $attribute;

    /**
     * @var string
     *
     * @ORM\Column(name="page", type="string", length=255)
     */
    private $page;

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
     * Set ru
     *
     * @param string $ru
     * @return TextTranslate
     */
    public function setRu($ru)
    {
        $this->ru = $ru;

        return $this;
    }

    /**
     * Get ru
     *
     * @return string 
     */
    public function getRu()
    {
        return $this->ru;
    }

    /**
     * Set en
     *
     * @param string $en
     * @return TextTranslate
     */
    public function setEn($en)
    {
        $this->en = $en;

        return $this;
    }

    /**
     * Get en
     *
     * @return string 
     */
    public function getEn()
    {
        return $this->en;
    }

    /**
     * Set ky
     *
     * @param string $ky
     * @return TextTranslate
     */
    public function setKy($ky)
    {
        $this->ky = $ky;

        return $this;
    }

    /**
     * Get ky
     *
     * @return string 
     */
    public function getKy()
    {
        return $this->ky;
    }

    /**
     * Set attribute
     *
     * @param string $attribute
     * @return TextTranslate
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * Get attribute
     *
     * @return string 
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Set page
     *
     * @param string $page
     * @return TextTranslate
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return string 
     */
    public function getPage()
    {
        return $this->page;
    }
}
