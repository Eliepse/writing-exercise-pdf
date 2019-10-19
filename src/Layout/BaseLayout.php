<?php


namespace Eliepse\WritingGrid\Layout;


use Eliepse\WritingGrid\Render\Renderer;
use Eliepse\WritingGrid\WordList;

abstract class BaseLayout
{
	/**
	 * @var int
	 */
//	public $headerHeight = 0;

	/**
	 * @var int
	 */
//	public $footerHeight = 0;

	/**
	 * @var int
	 */
	public $wordsPerPage = 12;

	/**
	 * @var string
	 */
	public $title = 'English exercise';


//	abstract public function header();
//	abstract public function footer();

	public function render(WordList $list, int $type = Renderer::OUTPUT_INLINE): ?string
	{
		return Renderer::render($this, $list, $type);
	}
}