<?php
namespace Instasaver\UserEnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="translations")
 */
 
 class Translate {
	/**
	* @ORM\Id
    * @ORM\Column(type="string", length=255)
	*/	 
	protected $keyword;
	/**
     * @ORM\Column(type="string", length=255)
     */
	protected $english;
	/**
     * @ORM\Column(type="string", length=255)
     */
	protected $polish;
	/**
     * @ORM\Column(type="string", length=255)
     */
	protected $russian;
 
    /**
     * Set keyword
     *
     * @param string $keyword
     *
     * @return Translate
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set english
     *
     * @param string $english
     *
     * @return Translate
     */
    public function setEnglish($english)
    {
        $this->english = $english;

        return $this;
    }

    /**
     * Get english
     *
     * @return string
     */
    public function getEnglish()
    {
        return $this->english;
    }

    /**
     * Set polish
     *
     * @param string $polish
     *
     * @return Translate
     */
    public function setPolish($polish)
    {
        $this->polish = $polish;

        return $this;
    }

    /**
     * Get polish
     *
     * @return string
     */
    public function getPolish()
    {
        return $this->polish;
    }

    /**
     * Set russian
     *
     * @param string $russian
     *
     * @return Translate
     */
    public function setRussian($russian)
    {
        $this->russian = $russian;

        return $this;
    }

    /**
     * Get russian
     *
     * @return string
     */
    public function getRussian()
    {
        return $this->russian;
    }
}
