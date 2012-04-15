<?php
namespace Pelshoff\Blog\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 *
 * @author		Pim Elshoff <pim@pelshoff.com>
 */
class Category
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var Article[]
     */
    protected $articles;

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

	/**
	 * @param Article[] $articles
	 */
    public function setArticles(array $articles)
    {
        $this->articles = $articles;
    }

	/**
	 * @return Article[]
	 */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
