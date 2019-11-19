<?php
/**
 * @var \Eliepse\WritingGrid\Layout\BaseLayout $layout
 * @var \Eliepse\WritingGrid\Content\Word $word
 * @var int $height
 */
?>
<div style="
		border-radius: 8px;
		padding: 6px 9px;
		width: 100%;
		height: <?= $height ?>px;">
	<div style="
			margin-top: -3px;
			font-size: 28px;
			font-width: bold;
			color: <?= $layout->colorWords ?>;">
		<?= $word->word ?>
	</div>
</div>
