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
		$chunks = array_chunk($this->words, $chunkSize);

		return array_map(
			function (int $index, array $words) {
				return new Page($index, $words);
			},
			array_keys($chunks),
			$chunks
		);
	}


	/**
	 * @param int $chunkSize
	 *
	 * @return int
	 */
	public function getPageCount(int $chunkSize = 12): int
	{
		return ceil(count($this->words) / $chunkSize);
	}
}