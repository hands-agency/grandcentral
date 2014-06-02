<? if (isset($results)): ?>
<? foreach ($results as $key => $results) : ?>
<h1><?=$results->count?></h1>
<ul>
	<? foreach ($results as $result): ?>
	<li>
		<a href="/admin/list?item=<?=$result['key']?>">
			<!--span class="icon ss-icon ss-<?=$result['key']?>"><a href="/admin/list?item=<?=$result['key']?>"></a></span-->
			<span class="title"><?=$result['title']?></span>
			<span class="descr"><?=$result['descr']?></span>
		</a>
	</li>
	<? endforeach ?>
</ul>
<? endforeach ?>
<? else: ?>
	<div class="nodata"><?=cst('nodata')?></div>
<? endif ?>
