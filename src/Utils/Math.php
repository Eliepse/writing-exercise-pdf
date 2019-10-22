<?php


namespace Eliepse\WritingGrid\Utils;


final class Math
{
	static public function pxtomm(int $px, $dpi = 72): float
	{
		return self::inchtomm($px / $dpi);
	}


	static public function inchtomm(float $inch): float
	{
		return $inch * 25.4;
	}
}