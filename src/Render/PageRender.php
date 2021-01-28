<?php


namespace Eliepse\WritingGrid\Render;


use Eliepse\WritingGrid\Content\Page;

final class PageRender extends RenderElement
{
	/**
	 * @param Page $page
	 *
	 * @throws \ErrorException
	 */
	public function __invoke(Page $page): void
	{
		$renderer = new RowRender($this->mpdf, $this->layout);
		foreach ($page->getWords() as $index => $word) {
			$renderer($index, $word);
		}
	}
}