<?php


namespace Eliepse\WritingGrid\Content;


final class Page
{
	/**
	 * Page constructor.
	 *
	 * @param Word[] $words
	 */
	public function __construct(private array $words = []) { }


	/**
	 * @return Word[]
	 */
	public function getWords(): array
	{
		return $this->words;
	}
}