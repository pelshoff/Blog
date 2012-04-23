<?php
namespace Pelshoff\Blog;

/**
 * Model for returning results from a context
 *
 * @author		Pim Elshoff <pim@pelshoff.com>
 */
class ContextResult
{
	const NONE = 'none';
	const FAILURE = 'failure';
	const SUCCESS = 'success';

	/**
	 * @var bool
	 */
	private $result;

	/**
	 * @param bool $result
	 */
	public function __construct($result)
	{
		$this->result = $result;
	}

	/**
	 * Indicate that the context has been opened by an event
	 *
	 * @return bool
	 */
	public function isOpened()
	{
		return $this->result != self::NONE;
	}

	/**
	 * Indicate that the context has been opened and succesfully closed
	 *
	 * @return bool
	 */
	public function isSuccess()
	{
		return $this->result == self::SUCCESS;
	}
}
