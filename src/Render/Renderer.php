<?php


namespace Eliepse\WritingGrid\Render;


use Eliepse\WritingGrid\Content\Page;
use Eliepse\WritingGrid\Content\Word;
use Eliepse\WritingGrid\Layout\BaseLayout;
use Eliepse\WritingGrid\WordList;
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
	 * Renderer constructor.
	 *
	 * @param BaseLayout $layout
	 * @param WordList $list
	 *
	 * @throws \Mpdf\MpdfException
	 */
	private function __construct(BaseLayout $layout, WordList $list)
	{
		$options = [
			'mode' => 'utf-8',
			'format' => [210, 297],
			'orientation' => 'P',
		];

		parent::__construct(new Mpdf($options), $layout);

		$this->list = $list;
		$this->configure();
		$this->metadata();
		(new HeaderRender($this->mpdf, $this->layout))();
		(new FooterRender($this->mpdf, $this->layout))();
	}


	private function configure(): void
	{
		$this->mpdf->autoPageBreak = false;
	}


	private function metadata(): void
	{
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


	static public function render(BaseLayout $layout, WordList $list, int $type = self::OUTPUT_INLINE): ?string
	{
		$renderer = new self($layout, $list);

		switch ($type) {
			case self::OUTPUT_INLINE:
				$renderer->outputInline();
				break;
			case self::OUTPUT_STRING:
				return $renderer->outputString();
				break;
			case self::OUTPUT_DOWNLOAD:
				$renderer->outputDownload();
				break;
		}

		return null;
	}
}