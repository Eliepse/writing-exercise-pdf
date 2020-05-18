<?php


namespace Eliepse\WritingGrid\Render;


use Eliepse\WritingGrid\Content\Word;
use Eliepse\WritingGrid\Layout\WithPinyinRules;
use Eliepse\WritingGrid\Utils\Html;
use Eliepse\WritingGrid\Utils\Math;
use ErrorException;

final class RowRender extends RenderElement
{
	/**
	 * The height of a signe row
	 *
	 * @var int
	 */
	private $height = 30;

	/**
	 * The space between rows
	 *
	 * @var int
	 */
	private $gutter = 10;


	/**
	 * @param int $index The position of the row
	 * @param Word $word The word to print
	 *
	 * @throws ErrorException
	 */
	public function __invoke(int $index, Word $word)
	{
		$x = $this->layout->getBodyOrigin()->x;
		$y = $this->layout->getBodyOrigin()->y + Math::pxtomm($index * ($this->height + $this->gutter));
		$w = $this->layout->getBodySizes()->x;

		// If pinyin rules apply, shift the word one line up
		$shiftWordY = is_a($this->layout, WithPinyinRules::class) ? Math::pxtomm(-6) : 0;

		$this->mpdf->WriteFixedPosHTML(
			Html::render('grid', [
				'layout' => $this->layout,
				'height' => $this->height,
				'isPinyin' => is_a($this->layout, WithPinyinRules::class),
			]), // html
			$x, // x
			$y, // y
			$w, // width
			$this->height, // height
		);

		$this->mpdf->WriteFixedPosHTML(
			Html::render('word', [
				'layout' => $this->layout,
				'height' => $this->height,
				'word' => $word,
			]), // html
			$x, // x
			$y + $shiftWordY, // y
			$w, // width
			$this->height, // height
		);

	}
}