<?php


namespace Eliepse\WritingGrid\Render;


use Eliepse\WritingGrid\Layout\BaseLayout;
use Mpdf\Mpdf;

abstract class RenderElement
{
	/**
	 * @var Mpdf
	 */
	protected $mpdf;

	/**
	 * @var BaseLayout
	 */
	protected $layout;


	public function __construct(Mpdf $mpdf, BaseLayout $layout)
	{
		$this->mpdf = $mpdf;
		$this->layout = $layout;
	}
}