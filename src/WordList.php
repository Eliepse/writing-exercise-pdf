<?php


namespace Eliepse\WritingGrid;


use Eliepse\WritingGrid\Content\Page;
use Eliepse\WritingGrid\Content\Word;

final class WordList
{
	/**
	 * @var array
	 */
	private $words = [];


	/**
	 * @param string $word
	 */
	public function addWord(string $word)
	{
		array_push($this->words, new Word($word));
	}


	/**
	 * @param int $chunkSize
	 *
	 * @return array<int, Page>
	 */
	public function getPages(int $chunkSize = 12): array
	{
		return array_map(
			function (array $words) {
				return new Page($words);
			},
			array_chunk($this->words, $chunkSize)
		);
	}
}