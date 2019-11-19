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
	public $headerHeight = 60;

	/**
	 * @var int
	 */
	public $footerHeight = 10;

	/**
	 * @var int
	 */
	public $wordsPerPage = 13;

	/**
	 * @var string
	 */
	public $title = 'English exercise';
	public $subject = 'A list of word for english exercise.';
	public $author = '';
	public $creator = '';
	public $keywords = '';

	public $pageMargin = [12, 30, 6, 30];

	public $colorTitle = '#2D3748';
	public $colorWords = '#2D3748';
	public $colorWordBackground = '#F4F7FA';
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