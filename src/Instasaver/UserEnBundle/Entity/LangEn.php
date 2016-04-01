<?php
namespace Instasaver\UserEnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="lang_en")
 */
 
 class LangEn { 
	/**
	* @ORM\Id
    * @ORM\Column(type="string", length=255)
	*/	 
	protected $keyword;
	/**
     * @ORM\Column(type="string", length=255)
     */
	protected $translation;
 
    /**
     * Set keyword
     *
     * @param string $keyword
     *
     * @return LangEn
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
     * Set translation
     *
     * @param string $translation
     *
     * @return LangEn
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * Get translation
     *
     * @return string
     */
    public function getTranslation()
    {
        return $this->translation;
    }
}
