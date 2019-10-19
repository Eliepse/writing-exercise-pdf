<?php


namespace Eliepse\WritingGrid\Content;


final class Page
{
	/**
	 * @var array
	 */
	private $words = [];

	/**
	 * @var int
	 */
	private $number;


	public function __construct(int $number, array $words = [])
	{
		$this->words = $words;
		$this->number = $number;
	}


	public function addWord(Word $word): void
	{
		array_push($this->words, $word);
	}


	public function getWords(): array
	{
		return $this->words;
	}


	public function getWord(int $index): ?Word
	{
		return $this->words[ $index ] ?? null;
	}


	public function getNumber(): int
	{
		return $this->number;
	}
}