<? if (!$events): ?>
<div class="nodata">As soon as something happens, we'll let you know right here</div>
<? else : ?>
<h1>Digest</h1>
<ol class="logbookList">
	<? foreach ($events as $period => $subject): ?>
	<!--h2><?=$period?></h2-->
	<?
	//	Divider
		if (!isset($lastPeriod) OR $lastPeriod != $period) echo '<li class="divider"><h2>'.cst('TIMELINE_PERIOD_'.$period, $period).'</h2></li>';
		$lastPeriod = $period;
	?>
	<? foreach ($subject as $subject => $event): ?>
		<!-- <h3>user <?=$subject?></h3> -->
		<? foreach ($event as $event => $items): ?>
			<!-- <h4><?=$event?></h4> -->
			<? foreach ($items as $structure => $items): ?>
				<!-- <h5><?=$structure?> </h5> -->
				<? $logbook = current($items) ?>
				<? $user = i('human', $subject, 'site') ?>
				<? $structure = i('item', $logbook['item']->get(), 'site') ?>
				<li data-item="<?=$logbook->get_nickname()?>">
					<?
						$thumbnail = (!$user['profilepic']->is_empty()) ? $user['profilepic']->unfold()[0]->thumbnail(100, null) : null;
						$empty = (!isset($thumbnail)) ? 'empty' : null;
					?>
					<div class="icon <?=$empty?>" data-item="human_<?=$user['owner'] ?>" data-item-link="timeline"><?=$thumbnail?></div>
					
					<div class="padding">

						<div class="title">
							
							<a href="<?=$user->edit() ?>" class="user"><?=$user['title'] ?></a>
							<?=cst('TIMELINE_EVENT_'.$event, $event)?>
							<? if (!isset($_GET['item'])): ?><a href="<?=$structure->edit()?>"><?=count($items)?> <?=$structure['title'] ?></a> :<? endif ?>
							
							<? $i = $and = 0 ?>
							<? foreach ($items as $item): ?>
								<? $item = i($item['item']->get(), $item['itemid']->get(), $_SESSION['pref']['handled_env']) ?>

								<? if (($item->exists()) && ($i < $displayItems)) : ?>
									<a href="<?= $item->edit()?>"><?= ($item['title']) ? $item['title'] : $item['key']; ?></a><? if ($i != count($items)-1): ?>, <? else : ?>.<? endif ?>
								<? else : $and++; endif ?>
								<? $i++ ?>
							<? endforeach ?>
							<? if ($and > 0): ?>
								and <a href=""><?=$and?> others</a>.
							<? endif ?>
						</div>
					
						<? if (isset($current['url'])): ?>
						<ul class="thumbnails">
							<? $i = 0 ?>
							<? foreach ($items as $item): ?>
							<? if ($i < $displayThumbnails): ?>
								<li>
									<div class="thumbnail small">
										<!--iframe src="<?=i($item['item'], $item['itemid'])['url']?>"></iframe-->
										<a class="thumbnailPlaceholder" href="<?=i($item['item']->get(), $item['itemid']->get())['url']?>"></a>
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
											
					</div>
				</li>
			<? endforeach ?>
		<? endforeach ?>
	<? endforeach ?>
<? endforeach ?>
</ol>
<? endif ?>

<?/*=sentinel::stopwatch().'s ('.database::query_count().' queries), using '.sentinel::memoryusage()*/?>

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
				author = '';	
				if (data['author']) author = '<div class="title"><a href="" class="user">'+data['author']+'</a></div>';
			//	Add descr
				descr = '';
				if (data['descr']) descr = '<div class="descr">'+data['descr']+'</div>';
				
			//	LI
				li = '<li data-item="'+item+'" style="display:none"><div class="icon"></div><div class="padding">'+author+descr+'</div></li>';
				$(li).prependTo('.logbookList').show('fast');
				
			//	No data ?
				if ($('.logbookList>li').length) $('.timeline>.nodata').hide();
			}
		}
	});
</script>
<? endif ?>