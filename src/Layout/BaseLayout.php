<?php


namespace Eliepse\WritingGrid\Layout;


use Eliepse\WritingGrid\Render\Renderer;
use Eliepse\WritingGrid\WordList;

abstract class BaseLayout
{
	/**
	 * @var int
	 */
	public $headerHeight = 50;

	/**
	 * @var int
	 */
	public $footerHeight = 10;

	/**
	 * @var int
	 */
	public $wordsPerPage = 12;

	/**
	 * @var string
	 */
	public $title = 'English exercise';

	public $pageMargin = [12, 30, 6, 30];

	public $colorTitle = '#2D3748';
	public $colorWords = '#2D3748';
	public $colorWordBackground = '#EDF2F7';
	public $colorFieldLine = '#718096';
	public $colorFieldLineMuted = '#CBD5E0';
	public $colorTextDefault = '#2D3748';


	public function getMargin(string $side): int
	{
		switch ($side) {
			case 'top':
				return $this->pageMargin[0];
			case 'right':
				return $this->pageMargin[1];
			case 'bottom':
				return $this->pageMargin[2];
			case 'left':
				return $this->pageMargin[3];
		}

		return 0;
	}


	/**
	 * @param WordList $list
	 * @param int $type
	 *
	 * @return string|void
	 * @throws \Mpdf\MpdfException
	 */
	public function render(WordList $list, int $type = Renderer::OUTPUT_INLINE)
	{
		return Renderer::output($this, $list, $type);
	}
}