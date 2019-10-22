<?php


namespace Eliepse\WritingGrid\Utils;


final class Path
{
	static public function base(string $path = ''): string
	{
		return __DIR__ . "/../../" . $path;
	}


	static public function resources(string $path = ''): string
	{
		return static::base('resources/' . $path);
	}
}