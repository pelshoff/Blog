<?php
namespace Pelshoff\Blog\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 *
 * @author		Pim Elshoff <pim@pelshoff.com>
 */
class Article
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var Author
     */
    protected $author;

    /**
     * @var Comment[]
     */
    protected $comments;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $leader;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $publishTime;

    /**
     * @var string
     */
    protected $lastUpdateTime;

    /**
     * @var string
     */
    protected $createdTime;

    /**
     * @var bool
     */
    protected $active;

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
     * @param Author $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

	/**
	 * @param Comment[] $comments
	 */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

	/**
	 * @return Comment[]
	 */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $createdTime
     */
    public function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;
    }

    /**
     * @return string
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
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
     * @param string $lastUpdateTime
     */
    public function setLastUpdateTime($lastUpdateTime)
    {
        $this->lastUpdateTime = $lastUpdateTime;
    }

    /**
     * @return string
     */
    public function getLastUpdateTime()
    {
        return $this->lastUpdateTime;
    }

    /**
     * @param string $leader
     */
    public function setLeader($leader)
    {
        $this->leader = $leader;
    }

    /**
     * @return string
     */
    public function getLeader()
    {
        return $this->leader;
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
     * @param string $publishTime
     */
    public function setPublishTime($publishTime)
    {
        $this->publishTime = $publishTime;
    }

    /**
     * @return string
     */
    public function getPublishTime()
    {
        return $this->publishTime;
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

	/**
	 * @return int
	 */
	public function getNumberOfComments()
	{
		return count($this->getComments());
	}
}
