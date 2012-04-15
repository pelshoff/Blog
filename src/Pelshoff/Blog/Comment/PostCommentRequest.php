<?php
namespace Pelshoff\Blog\Comment;

/**
 *
 *
 * @author		Pim Elshoff <pim@pelshoff.com>
 */
class PostCommentRequest
{
	/**
	 * @var string
	 */
	private $articleUrl;

	/**
	 * @var string
	 */
	private $clientIp;

	/**
	 * @param string $articleUrl
	 * @param string $clientIp
	 */
	public function __construct($articleUrl, $clientIp)
	{
		$this->articleUrl = $articleUrl;
		$this->clientIp = $clientIp;
	}

	/**
	 * @return string
	 */
	public function getArticleUrl()
	{
		return $this->articleUrl;
	}

	/**
	 * @return string
	 */
	public function getClientIp()
	{
		return $this->clientIp;
	}
}
