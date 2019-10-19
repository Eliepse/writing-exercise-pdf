<?php


namespace Eliepse\WritingGrid\Render;


use Eliepse\WritingGrid\Content\Page;
use Eliepse\WritingGrid\Layout\BaseLayout;
use Mpdf\Mpdf;

final class PageRender extends RenderElement
{
	public function __invoke(Page $page)
	{
		$this->renderPageHeader($page);
		$this->renderPageBody($page);
		$this->renderPageFooter($page, $page->getNumber());
	}


	private function renderPageHeader(Page $page) { }


	private function renderPageBody(Page $page)
	{
		$wordsCount = count($page->getWords());
		for ($i = 0; $i < $wordsCount; $i++) {
			(new WordRender($this->mpdf, $this->layout))($page->getWord($i), $i);
		}
	}


	private function renderPageFooter(Page $page, int $index) { }
}