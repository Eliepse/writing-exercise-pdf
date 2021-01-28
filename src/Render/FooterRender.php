<?php


namespace Eliepse\WritingGrid\Render;


use Eliepse\WritingGrid\Utils\Html;

final class FooterRender extends RenderElement
{
	public function __invoke(): void
	{
		$this->mpdf->SetHTMLFooter(
			Html::render(
				'footer',
				[
					'layout' => $this->layout,
				]
			)
		);
	}
}