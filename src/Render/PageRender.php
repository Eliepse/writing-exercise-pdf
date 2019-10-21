<?php


namespace Eliepse\WritingGrid\Render;


use Eliepse\WritingGrid\Content\Page;
use Eliepse\WritingGrid\Layout\BaseLayout;
use Eliepse\WritingGrid\Utils\Html;
use Mpdf\Mpdf;

final class PageRender extends RenderElement
{
	public function __invoke(Page $page)
	{
		$this->mpdf->WriteHTML(
			Html::render('wordsList', [
				'layout' => $this->layout,
				'page' => $page,
			])
		);
	}
}