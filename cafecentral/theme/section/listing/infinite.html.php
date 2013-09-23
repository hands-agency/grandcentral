<? if ($bunch->count == 0) : ?>
<div class="nodata">Nope, sorry, nothing. Zero. Zilch.</div>
<? else : ?>
<p><?=$abstract?></p>
<h2>A</h2>
<ol>
	<? foreach($bunch->data as $item) : ?>
	<li data-item="<?=$item->get_table()?>_<?=$item['id']?>">
		
		<? if (isset($mediaAttr) && ($item[$mediaAttr])): ?>
		<? $media = new image($item[$mediaAttr][0]) ?>
		<div class="media"><a href="<?=$item->edit()?>"><?=$media?></a></div>
		<? endif ?>
			
		<div class="padding">
			
			<div class="icon small"><? if (isset($structure['icon'])): ?><i class="icon-<?=$structure['icon']?>"></i><? endif ?></div>
		
			<div class="title"><a href="<?=$item->edit()?>"><?=$item['title']?></a> <a href="<?=$item->link()?>" class="reach">➚</a></div>
		
			<? if (isset($item['descr'])): ?><div class="descr"><?=text::cut($item['descr'], 350)?></div><? endif ?>
		</div>
		
		<ul class="action">
			<li><a href="" class="notes">Discussion</a></li>
			<? $date = new date($item['created']); ?>
			<li class="icon-time"><?=$date->time_since() ?></li>
		</ul>
		
		<div class="notes"></div>
		
	</li>
	<? endforeach ?>
</ol>
<? endif; ?>
<div class="clear"><!-- Clearing floats --></div>