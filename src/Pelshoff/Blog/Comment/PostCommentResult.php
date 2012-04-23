<?php

namespace Pelshoff\Blog\Comment;

use Pelshoff\Blog\ContextResult,
	Pelshoff\Blog\Model\Article,
	Pelshoff\Blog\Model\Comment;

/**
 * Model for returning results from posting a comment
 *
 * @author		Pim Elshoff <pim@pelshoff.com>
 */
class PostCommentResult extends ContextResult
{
	/**
	 * @var Article
	 */
	private $article;

	/**
	 * @var Comment
	 */
	private $comment;

	/**
	 * @param bool $result
	 * @param Article $article
	 * @param Comment $comment
	 */
	public function __construct($result, Article $article = null, Comment $comment = null)
	{
		parent::__construct($result);
		$this->article = $article;
		$this->comment = $comment;
	}

	/**
	 * @return Article
	 */
	public function getArticle()
	{
		return $this->article;
	}

	/**
	 * @return Comment
	 */
	public function getComment()
	{
		return $this->comment;
	}
}
