<?php


namespace Eliepse\WritingGrid;


class Point
{
	/**
	 * @var int
	 */
	public $x = 0;

	/**
	 * @var int
	 */
	public $y = 0;


	public function __construct(int $x = 0, int $y = 0)
	{
		$this->x = $x;
		$this->y = $y;
	}
}