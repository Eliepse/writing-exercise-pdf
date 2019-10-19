<?php


namespace Eliepse\WritingGrid\Content;


final class Word
{
	/**
	 * @var string
	 */
	public $word;


	public function __construct(string $word)
	{
		$this->word = $word;
	}
}