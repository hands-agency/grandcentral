<? foreach ($filter as $filter => $array) : ?>
<li>
	<ul data-filter="<?=$filter?>">
	<li class="legend"><?=cst('OPTIONS_FILTERS_LEGEND_'.$filter, $filter)?></li>
	<? foreach ($array as $cell) : ?>
	<?
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
			$title = $cell['title'];
			$descr = isset($cell['descr']) ? $cell['descr'] : null;
		}
		
	?>
	<li data-value="<?=$key?>" class="off">
		<div class="title"><?=$title ?></div>
		<? if (isset($descr)) : ?><div class="descr"><?=$descr?></div><? endif ?>
	</li>
	<? endforeach; ?>
	</ul>
</li>
<? endforeach; ?>
<li class="clear"><!-- Clearing floats --></li>