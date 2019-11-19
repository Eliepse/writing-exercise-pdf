<?php


namespace Eliepse\WritingGrid\Render;


use Eliepse\WritingGrid\Content\Page;
use Eliepse\WritingGrid\Content\Word;

final class PageRender extends RenderElement
{
	/**
	 * @param Page $page
	 *
	 * @throws \ErrorException
	 */
	public function __invoke(Page $page)
	{
		$renderer = new RowRender($this->mpdf, $this->layout);

		/** @var Word $word */
		foreach ($page->getWords() as $index => $word) {
			$renderer($index, $word);
		}

	}
}