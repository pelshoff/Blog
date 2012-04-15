<?php
namespace Pelshoff\Blog\Model;

/**
 *
 *
 * @author		Pim Elshoff <pim@pelshoff.com>
 */
interface CommentRepository
{
	/**
	 * @return Comment
	 */
	public function create();

	/**
	 * @param Comment $comment
	 */
	public function store(Comment $comment);
}
