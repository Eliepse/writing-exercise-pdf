<?php


namespace Eliepse\WritingGrid\Render;


use Eliepse\WritingGrid\Layout\BaseLayout;
use Eliepse\WritingGrid\Utils\Math;
use Eliepse\WritingGrid\Utils\Path;
use Eliepse\WritingGrid\WordList;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

final class Renderer extends RenderElement
{
	public const OUTPUT_INLINE = 0;
	public const OUTPUT_DOWNLOAD = 1;
	public const OUTPUT_STRING = 2;

	/**
	 * @var WordList
	 */
	private $list;

	/**
	 * @var bool
	 */
	private $rendered = false;


	/**
	 * Renderer constructor.
	 *
	 * @param BaseLayout $layout
	 * @param WordList $list
	 *
	 * @throws \Mpdf\MpdfException
	 */
	private function __construct(BaseLayout $layout, WordList $list)
	{
		parent::__construct(new Mpdf($this->getMPDFInitConfigs()), $layout);

		$this->list = $list;
		$this->configure();
		$this->metadata();
		(new HeaderRender($this->mpdf, $this->layout))();
		(new FooterRender($this->mpdf, $this->layout))();
	}


	private function getMPDFInitConfigs(): array
	{
		return [
			'mode' => 'utf-8',
			'format' => [210, 297],
			'orientation' => 'P',
			'margin_top' => Math::pxtomm(12),
			'margin_left' => Math::pxtomm(30),
			'margin_right' => Math::pxtomm(30),
			'margin_bottom' => Math::pxtomm(6),
			'margin_header' => Math::pxtomm(12),
			'margin_footer' => Math::pxtomm(6),
			'fontdata' => $this->getFontDataConfig(),
		];
	}


	private function getFontDataConfig(): array
	{
		return array_merge(
			(new FontVariables())->getDefaults()['fontdata'],
			[
				'caveat' => [
					'R' => 'Caveat-Regular.ttf',
					'B' => 'Caveat-Bold.ttf',
					'useOTL' => 0x03,
				],
			]
		);
	}


	private function configure(): void
	{
		$this->mpdf->autoPageBreak = false;
		$this->mpdf->AddFontDirectory(Path::resources('fonts/'));
		$this->mpdf->SetDefaultFont('caveat');
	}


	private function metadata(): void
	{
	}


	public function render(): void
	{
		if ($this->rendered) {
			return;
		}

		$this->rendered = true;

		$pages = $this->list->getPages();

		for ($pageIndex = 0; $pageIndex < count($pages); $pageIndex++) {
			if ($pageIndex !== 0) {
				$this->mpdf->AddPage();
			}
			(new PageRender($this->mpdf, $this->layout))($pages[ $pageIndex ]);
		}
	}


	public function outputInline(): void
	{
		$this->mpdf->Output('', Destination::INLINE);
	}


	public function outputString(): string
	{
		return $this->mpdf->Output('', Destination::STRING_RETURN);
	}


	public function outputDownload(): void
	{
		$this->mpdf->Output('', Destination::DOWNLOAD);
	}


	/**
	 * @param BaseLayout $layout
	 * @param WordList $list
	 * @param int $type
	 *
	 * @return string|void
	 * @throws \Mpdf\MpdfException
	 */
	static public function output(BaseLayout $layout, WordList $list, int $type = self::OUTPUT_INLINE)
	{
		$renderer = new self($layout, $list);
		$renderer->render();

		switch ($type) {
			case self::OUTPUT_STRING:
				return $renderer->outputString();
				break;
			case self::OUTPUT_DOWNLOAD:
				$renderer->outputDownload();
				break;
		}

		$renderer->outputInline();
	}
}