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

	public $colorTitle = '#2D3748';
	public $colorWords = '#2D3748';
	public $colorWordBackground = '#EDF2F7';
	public $colorFieldLine = '#718096';
	public $colorFieldLineMuted = '#CBD5E0';
	public $colorTextDefault = '#2D3748';


	public function render(WordList $list, int $type = Renderer::OUTPUT_INLINE): ?string
	{
		return Renderer::output($this, $list, $type);
	}
}