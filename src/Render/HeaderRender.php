<?php


namespace Eliepse\WritingGrid\Render;


use Eliepse\WritingGrid\Utils\Html;

final class HeaderRender extends RenderElement
{
	public function __invoke()
	{
		$this->mpdf->SetHTMLHeader(
			Html::render(
				'header',
				[
					'layout' => $this->layout,
				]
			)
		);
	}
}