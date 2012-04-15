<?php
namespace Pelshoff\DCI;

/**
 * User event listener contexts can respond to
 *
 * @author		Pim Elshoff <pim@pelshoff.com>
 */
interface UserEventListener
{
	/**
	 * @return bool
	 */
	public function isSubmitted();

	/**
	 * @return bool
	 */
	public function isValid();

	/**
	 * @return array
	 */
	public function getData();
}
