<? if (!$bunch->count()) : ?>
<div class="nodata">Nope, sorry, nothing. Zero. Zilch.</div>
<? else : ?>
<p><?=$abstract?></p>

<? foreach($bunch as $item) : ?>
	
<?
//	Change separators
	$currentLetter = strtoupper(substr($item['title'], 0, 1));
	if (!isset($lastLetter)) echo '<h2>'.$currentLetter.'</h2><ol>';
	else if ($lastLetter != $currentLetter) echo '</ol><h2>'.$currentLetter.'</h2><ol>';
?>
		
	<li data-item="<?=$item->get_nickname()?>">
			
		<?
			if (isset($icon)) $thumbnail = media($item[$icon][0]['url'])->thumbnail(120, null);
			$empty = (!isset($thumbnail)) ? 'empty' : null;
		?>
		<div class="icon <?=$empty?>"><?=$thumbnail?></div>
		
		<div class="title"><a href="<?=$item->edit()?>"><?= (!empty($item['title'])) ? $item['title'] : $item['key'] ?></a></div>
		
		<? if (isset($item['descr'])): ?><div class="descr"><?=$item['descr']->cut(350)?></div><? endif ?>
		
		<ul class="action">
			<li><a href="" class="notes">Discussion</a></li>
			<li class="icon-time"><?=$item['created']->time_since() ?></li>
		</ul>
		
		<div class="notes"></div>
		
		<? $lastLetter = strtoupper(substr($item['title'], 0, 1)) ?>
	</li>
	<? endforeach ?>
</ol>
<? endif; ?>
<div class="clear"><!-- Clearing floats --></div>