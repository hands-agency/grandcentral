<ul class="optionsList">
	<?php foreach ($filter as $filter => $array) : ?>
	<li>
		<ul data-filter="<?=$filter?>" data-type="<?=$array['type']?>">
		<li class="legend"><?=cst('OPTIONS_FILTERS_LEGEND_'.$filter, $filter)?></li>
		<?php foreach ($array['data'] as $cell) : ?>
		<?php
		//	We can either have a bunch or some data
			$title = $descr = $key = null;
			if (is_string($cell))
			{
				$key = $cell;
				$title = cst('OPTIONS_FILTER_'.$filter.'_'.$cell.'_TITLE', $cell);
				$descr =  cst('OPTIONS_FILTER_'.$filter.'_'.$cell.'_DESCR', $cell);
			}
			if (is_array($cell) OR is_object($cell))
			{
				$key = $cell['key'];
				$title = isset($cell['title']) ? $cell['title'] : $cell['key'];
				$descr = isset($cell['descr']) ? $cell['descr'] : null;
			}
		//	on/off
			$class = (isset($_SESSION['user']['pref']['list'][$handled_item][$filter]) && $key == $_SESSION['user']['pref']['list'][$handled_item][$filter]) ? 'on' : 'off';
		?>
		<li data-value="<?=$key?>" class="<?=$class?>">
			<div class="title"><?=$title ?></div>
			<?php if (isset($descr)) : ?><div class="descr"><?=$descr?></div><?php endif ?>
		</li>
		<?php endforeach; ?>
		</ul>
	</li>
	<?php endforeach; ?>
</ul>