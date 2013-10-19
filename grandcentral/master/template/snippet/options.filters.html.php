<? foreach ($filter as $filter => $bunch) : ?>
<li>
	<ul data-filter="<?=$filter?>">
	<li class="legend"><?=$filter?></li>
	<? foreach ($bunch as $item) : ?>
	<li data-value="<?=$item['key']?>" class="off">
		<div class="title"><?=$item['title']?></div>
		<? if (isset($item['descr'])) : ?><div class="descr"><?=$item['descr']?></div><? endif ?>
	</li>
	<? endforeach; ?>
	</ul>
</li>
<? endforeach; ?>
<li class="clear"><!-- Clearing floats --></li>