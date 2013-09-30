<? foreach ($ini as $h2 => $h3) : ?>
	<h2><?=$h2?></h2>
	<? foreach ($h3 as $h3 => $content) : ?>
	<table>
		<tr>
			<th><strong><?=$h3?></strong></th>
			<td>
			<?php if (is_array($content)): ?>
				<ul>
					<? foreach ($content as $li) : ?><li><?=$li?></li><? endforeach ?>
				</ul>
			<? else : ?>
				<p><?=$content?></p>
			<? endif ?>
			</td>
		</tr>
	</table>
	<? endforeach ?>
<? endforeach ?>