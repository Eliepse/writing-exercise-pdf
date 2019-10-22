<?php


namespace Eliepse\WritingGrid\Content;


final class Page
{
	/**
	 * @var array
	 */
	private $words = [];


	public function __construct(array $words = [])
	{
		$this->words = $words;
	}


	public function getWords(): array
	{
		return $this->words;
	}
}