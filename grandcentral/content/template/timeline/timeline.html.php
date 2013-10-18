<? if (!$events): ?>
<div class="nodata">As soon as something happens, we'll let you know right here</div>
<? else : ?>
<ol class="logbookList">
	<? foreach ($events as $period => $subject): ?>
	<!--h2><?=$period?></h2-->
	<?
	//	Divider
		if (!isset($lastPeriod) OR $lastPeriod != $period) echo '<li class="divider"><h2>'.constant('TIMELINE_PERIOD_'.strtoupper($period)).'</h2></li>';
		$lastPeriod = $period;
	?>
	<? foreach ($subject as $subject => $event): ?>
		<!-- <h3>user <?=$subject?></h3> -->
		<? foreach ($event as $event => $structures): ?>
			<!-- <h4><?=$event?></h4> -->
			<? foreach ($structures as $structure => $items): ?>
				<!-- <h5><?=$structure?> </h5> -->
				<? $logbook = current($items) ?>
				<? $user = cc('human', $subject, 'site') ?>
				<? $structure = cc('structure', $logbook['item'], 'site') ?>
				<li data-item="<?=$logbook->get_table().'_'.$logbook['id']?>">
					<div class="padding">
						<div class="icon medium icon-<?=$structure['icon']?>"></div>
					
						<div class="title">
							<a href="<?=$user->edit() ?>#timeline" class="user"><?=$user['title'] ?></a> <?=cst('TIMELINE_EVENT_'.$event, $event)?> <? if (!isset($_GET['item'])): ?><a href="<?=cc('structure', $structure, $_SESSION['pref']['handled_env'])->edit()?>"><?=cc('structure', $structure, $_SESSION['pref']['handled_env'])['title'] ?></a> :<? endif ?>
							<? $i = $and = 0 ?>
							<? foreach ($items as $item): ?>
								<? $item = cc($item['item']->get(), $item['itemid']->get(), $_SESSION['pref']['handled_env']) ?>

								<? if (($item->exists()) && ($i < $displayItems)) : ?>
									<a href="<?= $item->edit()?>"><?= ($item['title']) ? $item['title'] : $item['key']; ?></a><? if ($i != count($items)-1): ?>, <? else : ?>.<? endif ?>
								<? else : $and++; endif ?>
								<? $i++ ?>
							<? endforeach ?>
							<? if ($and > 0): ?>
								and <a href=""><?=$and?> others</a>.
							<? endif ?>
						</div>
						
						<ul class="descr">
							<? $i = 0 ?>
							<? foreach ($items as $item): ?>
							<? if ($i < $displayThumbnails): ?>
								<li>
									<div class="descr"><?=cc($item['item']->get(), $item['itemid']->get(), $_SESSION['pref']['handled_env'])['descr']?></div>
								</li>
							<? endif ?>
							<? $i++ ?>
							<? endforeach ?>
						</ul>					
					</div>
					
					<? if (isset($current['url'])): ?>
					<ul class="thumbnails">
						<? $i = 0 ?>
						<? foreach ($items as $item): ?>
						<? if ($i < $displayThumbnails): ?>
							<li>
								<div class="thumbnail small">
									<!--iframe src="<?=cc($item['item'], $item['itemid'])['url']?>"></iframe-->
									<a class="thumbnailPlaceholder" href="<?=cc($item['item']->get(), $item['itemid']->get())['url']?>"></a>
								</div>
							</li>
						<? endif ?>
						<? $i++ ?>
						<? endforeach ?>
					</ul>
					<? endif ?>
					
					<ul class="action">
						<li><a href="" class="notes">Discussion</a></li>
						<? if ($event == 'update' && count($items) == 1): ?><li><a href="" class="compare">What's new</a></li><? endif ?>
						<li class="icon-time"><?=$logbook['created']->time_since() ?></li>
					</ul>
					
					<div class="notes"></div>
				</li>
			<? endforeach ?>
		<? endforeach ?>
	<? endforeach ?>
<? endforeach ?>
</ol>
<? endif ?>

<? if (isset($EventSource)) : ?>
<script type="text/javascript" charset="utf-8">
//	truc
	$.sse(
	{
		source:'<?=$EventSource?>',
		datetime:'<?=date('Y-m-d H:i:s')?>',
		onMessage:function(e)
		{
		//	Get the data
			data = JSON.parse(e.data);
			item = data['item']+'_'+e.lastEventId;
		//	Ensure the items get loaded just one time
			if ($('.logbookList>li[data-item='+item+']').length == 0) 
			{
			//	Delete loadings
				$('.logbookList .loading').remove();
				
			//	Add user
				if (data['author']) author = '<div class="title"><a href="" class="user">'+data['author']+'</a></div>';
				else author = '';
			//	Add descr
				if (data['descr']) descr = '<div class="descr">'+data['descr']+'</div>';
				else descr = '';
				
			//	LI
				li = '<li data-item="'+item+'" style="display:none"><div class="icon"></div>'+author+descr+'<div class="date">'+data['created']+'</div></li>';
				$(li).prependTo('.logbookList').show('fast');
				
			//	No data ?
				if ($('.logbookList>li').length) $('.timeline>.nodata').hide();
			}
		}
	});
</script>
<? endif ?>