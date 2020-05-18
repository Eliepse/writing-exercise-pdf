<?php
/**
 * @var \Eliepse\WritingGrid\Layout\BaseLayout $layout
 * @var \Eliepse\WritingGrid\Content\Word $word
 * @var int $height
 * @var bool $isPinyin
 */
?>
<div style="
		background-color: <?= $layout->colorWordBackground ?>;
		border-radius: 8px;
		padding: 6px 9px;
		width: 100%;
		height: <?= $height ?>px;">
	<div style="border-bottom: 1px solid <?= $layout->colorFieldLineMuted ?>; margin-top: 4px;"></div>
	<div style="border-bottom: 1px solid <?= $layout->colorFieldLineMuted ?>; margin-top: 6px;"></div>
	<div style="border-bottom: 1px solid <?= $isPinyin ? $layout->colorFieldLine : $layout->colorFieldLineMuted ?>; margin-top: 6px;"></div>
	<div style="border-bottom: 1px solid <?= $isPinyin ? $layout->colorFieldLineMuted : $layout->colorFieldLine ?>; margin-top: 6px;"></div>
</div>
