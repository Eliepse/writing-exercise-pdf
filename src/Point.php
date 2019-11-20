<?php


namespace Eliepse\WritingGrid;


class Point
{
	/**
	 * @var float
	 */
	public $x = 0;

	/**
	 * @var float
	 */
	public $y = 0;


	public function __construct(float $x = 0.0, float $y = 0.0)
	{
		$this->x = $x;
		$this->y = $y;
	}
}