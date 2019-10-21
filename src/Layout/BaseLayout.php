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
	public $colorTextDefault = '#2D3748';

//	abstract public function header();
//	abstract public function footer();

	public function render(WordList $list, int $type = Renderer::OUTPUT_INLINE): ?string
	{
		return Renderer::output($this, $list, $type);
	}
}