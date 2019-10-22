<?php
/**
 * @var \Eliepse\WritingGrid\Layout\BaseLayout $layout
 * @var \Eliepse\WritingGrid\Content\Page $page
 * @var \Eliepse\WritingGrid\Content\Word $word
 */
?>
<div style="padding-top: <?= $layout->headerHeight + $layout->getMargin('top') ?>px">
	<?php foreach ($page->getWords() as $word): ?>
		<div style="background-color: <?= $layout->colorWordBackground ?>; border-radius: 8px; padding: 6px 9px; margin: 10px 0;">
			<h2 style="font-size: 14px; font-weight: bold; color:<?= $layout->colorWords ?>; margin: 0 0 10px 0;">
				<?= $word->word ?>
			</h2>
			<div style="border-bottom: 1px solid <?= $layout->colorFieldLineMuted ?>; margin-top: 6px;"></div>
			<div style="border-bottom: 1px solid <?= $layout->colorFieldLineMuted ?>; margin-top: 6px;"></div>
			<div style="border-bottom: 1px solid <?= $layout->colorFieldLineMuted ?>; margin-top: 6px;"></div>
			<div style="border-bottom: 1px solid <?= $layout->colorFieldLine ?>; margin-top: 6px;"></div>
		</div>
	<?php endforeach; ?>
</div>
