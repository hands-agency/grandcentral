<?php foreach($bunch as $item) : ?>
<?php
//	format Current Separator
	$currentSeparator = formatSeparator($item[$order]);
//	Change separators
	if (!isset($lastSeparator)) echo '<h2><span class="rule">'.$currentSeparator.'</span></h2><ol>';
	else if ($lastSeparator != $currentSeparator) echo '</ol><h2><span class="rule">'.$currentSeparator.'</span></h2><ol>';
//	Save & format last Separator	
	$lastSeparator = formatSeparator($item[$order]);
?>	
<li data-item="<?=$item->get_nickname()?>" data-live="<?=$item['live']?>">
	<?php
		if ($iconField)
		{
			$images = $item[$iconField]->unfold();
			$thumbnail = (!$item[$iconField]->is_empty() && $images[0]->exists()) ? $images[0]->thumbnail(200, null) : null;
		}
		else $thumbnail = null;
		$empty = (!isset($thumbnail)) ? 'empty' : null;
	?>
	<div class="icon <?=$empty?>"><a href="<?=$item->edit()?>"><?=$thumbnail?></a></div>
	
	<div class="title"><a href="<?=$item->edit()?>"><?= (isset($item['title']) && !$item['title']->is_empty()) ? $item['title'] : $item->get_table().'#'.$item['id'] ?></a></div>
	
	<?php /* if (isset($item['descr'])): ?><div class="descr"><?=$item['descr']->cut(200)?></div><?php endif */ ?>
	
	<ul class="action">
		<li><a href="" class="notes">Discussion</a></li>
		<li class="icon-time"><?=$item['created']->time_since() ?></li>
	</ul>
	
	<div class="notes"></div>
</li>
<?php endforeach ?>