<?php
/**
 * @var \Eliepse\WritingGrid\Layout\BaseLayout $layout
 */
?>
<div style="height: <?= $layout->headerHeight ?>px">
	<table style="width: 100%; table-layout: fixed;">
		<tbody>
		<tr>
			<td></td>
			<td style="text-align: center; vertical-align: middle; height: <?= $layout->headerHeight ?>px;">
				<div style="
						font-family: caveat, sans-serif;
						font-size: 18pt;
						font-weight: bold;
						color: <?= $layout->colorTitle ?>;">
					<?= $layout->title ?>
				</div>
			</td>
			<td>

			</td>
		</tr>
		</tbody>
	</table>
</div>
