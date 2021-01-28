<?php


namespace Eliepse\WritingGrid\Layout;


use Eliepse\WritingGrid\Point;
use Eliepse\WritingGrid\Render\Renderer;
use Eliepse\WritingGrid\Utils\Math;
use Eliepse\WritingGrid\WordList;

abstract class BaseLayout
{
	/**
	 * @var int
	 */
	public int $headerHeight = 60;

	/**
	 * @var int
	 */
	public int $footerHeight = 10;

	/**
	 * @var int
	 */
	public int $wordsPerPage = 18;

	/**
	 * @var string
	 */
	public string $title = 'English exercise';
	public string $subject = 'A list of word for english exercise.';
	public string $author = '';
	public string $creator = '';
	public string $keywords = '';

	/** @var int[] */
	public array $pageMargin = [12, 30, 6, 30];

	public string $colorTitle = '#2D3748';
	public string $colorWords = '#2D3748';
	public string $colorWordBackground = '#F4F7FA';
	public string $colorFieldLine = '#718096';
	public string $colorFieldLineMuted = '#CBD5E0';
	public string $colorTextDefault = '#2D3748';


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


	public function getBodyOrigin(): Point
	{
		return new Point(
			Math::pxtomm($this->getMargin('left')),
			Math::pxtomm($this->headerHeight + $this->getMargin('top'))
		);
	}


	public function getBodySizes(): Point
	{
		return new Point(
			210 - Math::pxtomm($this->getMargin('left') + $this->getMargin('right')),
			297 - Math::pxtomm(
				$this->getMargin('top')
				+ $this->getMargin('bottom')
				+ $this->headerHeight
				+ $this->footerHeight)
		);
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