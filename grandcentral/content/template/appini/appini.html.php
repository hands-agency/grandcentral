<h1><?=$ini['about']['title']?></h1>
<? foreach ($ini as $h2 => $h3) : ?>

	<?
		$content = null;
		foreach ($h3 as $h3 => $line)
		{
			$td = null;
			if (is_array($line))
			{
				foreach ($line as $li) $td .= '<li>'.$li.'</li>';
				$td = '<ul>'.$td.'</ul>';
			}
			else $td = '<p>'.$line.'</p>';

			if ($td)
			{
				$content .= '
				<table>
					<tr>
						<th>'.$h3.'</th>
						<td>'.$td.'</td>
					</tr>
				</table>';
			}
		}
	?>
	
	<? if ($content): ?>
		<h2><span class="centered"><?=cst('APPINI_H2_'.$h2, $h2)?></span></h2>
		<?=$content?>
	<? endif ?>
	
<? endforeach ?>