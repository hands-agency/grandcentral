<? foreach($bunch as $item) : ?>
<?
//	format Current Separator
	$currentSeparator = formatSeparator($item[$order]);
//	Change separators
	if (!isset($lastSeparator)) echo '<h2>'.$currentSeparator.'</h2><ol>';
	else if ($lastSeparator != $currentSeparator) echo '</ol><h2>'.$currentSeparator.'</h2><ol>';
//	Save & format last Separator	
	$lastSeparator = formatSeparator($item[$order]);
?>	
<li data-item="<?=$item->get_nickname()?>">
	<?
		$images = $item[$iconField]->unfold();
		$thumbnail = (!$item[$iconField]->is_empty() && $images[0]->exists()) ? $images[0]->thumbnail(200, null) : null;
		$empty = (!isset($thumbnail)) ? 'empty' : null;
	?>
	<div class="icon <?=$empty?>"><a href="<?=$item->edit()?>"><?=$thumbnail?></a></div>
	
	<div class="title"><a href="<?=$item->edit()?>"><?= (!empty($item['title'])) ? $item['title'] : $item['key'] ?></a></div>
	
	<? if (isset($item['descr'])): ?><div class="descr"><?=$item['descr']->cut(200)?></div><? endif ?>
	
	<ul class="action">
		<li><a href="" class="notes">Discussion</a></li>
		<li class="icon-time"><?=$item['created']->time_since() ?></li>
	</ul>
	
	<div class="notes"></div>
</li>
<? endforeach ?>