<?php
namespace Pelshoff\DCI;

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
	 * @return bool
	 */
	public function isOpened()
	{
		return $this->result != self::NONE;
	}

	/**
	 * @return bool
	 */
	public function isSuccess()
	{
		return $this->result == self::SUCCESS;
	}
}
