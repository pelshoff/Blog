<?php
namespace Pelshoff\Blog\Model;

/**
 *
 *
 * @author		Pim Elshoff <pim@pelshoff.com>
 */
interface ArticleRepository
{
	/**
	 * @param string $url
	 * @return Article
	 */
	public function findArticleByUrl($url);
}
