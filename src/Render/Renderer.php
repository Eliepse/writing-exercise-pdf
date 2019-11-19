<?php


namespace Eliepse\WritingGrid\Render;


use Eliepse\WritingGrid\Layout\BaseLayout;
use Eliepse\WritingGrid\Utils\Math;
use Eliepse\WritingGrid\Utils\Path;
use Eliepse\WritingGrid\WordList;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Mpdf\Output\Destination;
use Mpdf\Utils\UtfString;

final class Renderer
{
	public const OUTPUT_INLINE = 0;
	public const OUTPUT_DOWNLOAD = 1;
	public const OUTPUT_STRING = 2;

	/**
	 * @var Mpdf
	 */
	protected $mpdf;

	/**
	 * @var BaseLayout
	 */
	protected $layout;

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
	 * @throws MpdfException
	 */
	private function __construct(BaseLayout $layout, WordList $list)
	{
		$this->layout = $layout;
		$this->mpdf = new Mpdf($this->getMPDFInitConfigs());
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
			'margin_top' => Math::pxtomm($this->layout->getMargin('top')),
			'margin_right' => Math::pxtomm($this->layout->getMargin('right')),
			'margin_bottom' => Math::pxtomm($this->layout->getMargin('bottom')),
			'margin_left' => Math::pxtomm($this->layout->getMargin('left')),
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
				'ecolier' => [
					'R' => 'Ecolier-Regular.ttf',
					'useOTL' => 0x00,
				],
			]
		);
	}


	private function configure(): void
	{
		$this->mpdf->autoPageBreak = false;
		$this->mpdf->AddFontDirectory(Path::resources('fonts/'));
		$this->mpdf->SetDefaultFont('ecolier');
		$this->mpdf->margin_header = Math::pxtomm($this->layout->getMargin('top'));
		$this->mpdf->margin_footer = Math::pxtomm($this->layout->getMargin('bottom'));
	}


	private function metadata(): void
	{
		$this->mpdf->SetTitle(UtfString::strcode2utf($this->layout->title));
		$this->mpdf->SetSubject(UtfString::strcode2utf($this->layout->subject));
		$this->mpdf->SetAuthor(UtfString::strcode2utf($this->layout->author));
		$this->mpdf->SetCreator(UtfString::strcode2utf($this->layout->creator));
		$this->mpdf->SetKeywords(UtfString::strcode2utf($this->layout->keywords));
	}


	public function render(): void
	{
		if ($this->rendered) {
			return;
		}
		$this->rendered = true;
		$pageRenderer = new PageRender($this->mpdf, $this->layout);
		foreach ($this->list->getPages($this->layout->wordsPerPage) as $index => $page) {
			if ($index !== 0) {
				$this->mpdf->AddPage();
			}
			$pageRenderer($page);
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
	 * @throws MpdfException
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