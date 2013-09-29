<? if (!$bunch->count()) : ?>
<div class="nodata">Nope, sorry, nothing. Zero. Zilch.</div>
<? else : ?>
<p><?=$abstract?></p>
<h2>A</h2>
<ol>
	<? foreach($bunch as $item) : ?>
	<li data-item="<?=$item->get_nickname()?>">
		
		<!--div class="media"><a href="<?=$item->edit()?>"></a></div-->
		
		<div class="padding">
			
			<div class="icon small"><? if (isset($structure['icon'])): ?><i class="icon-<?=$structure['icon']?>"></i><? endif ?></div>
		
			<div class="title"><a href="<?=$item->edit()?>"><?=$item['title']?></a> <a href="<?=$item->link()?>" class="reach">➚</a></div>
		
			<? if (isset($item['descr'])): ?><div class="descr"><?=$item['descr']->cut(350)?></div><? endif ?>
		</div>
		
		<ul class="action">
			<li><a href="" class="notes">Discussion</a></li>
			<li class="icon-time"><?=$item['created']->time_since() ?></li>
		</ul>
		
		<div class="notes"></div>
		
	</li>
	<? endforeach ?>
</ol>
<? endif; ?>
<div class="clear"><!-- Clearing floats --></div>