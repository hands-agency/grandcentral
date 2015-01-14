<?php if (!empty($events)): ?>
<ol class="logbookList">
	<?php foreach ($events as $period => $subject): ?>
	<!--h2><?=$period?></h2-->
	<?php
	//	Divider
		if (!isset($lastPeriod) OR $lastPeriod != $period) echo '<li class="divider"><h2>'.cst('TIMELINE_PERIOD_'.$period, $period).'</h2></li>';
		$lastPeriod = $period;
	?>
	<?php foreach ($subject as $subject => $event): ?>
		<!-- <h3>user <?=$subject?></h3> -->
		<?php foreach ($event as $event => $items): ?>
			<!-- <h4><?=$event?></h4> -->
			<?php foreach ($items as $structure => $items): ?>
				<!-- <h5><?=$structure?> </h5> -->
				<?php $logbook = current($items) ?>
				<?php $user = i('human', $subject, 'site') ?>
				<?php $structure = i('item', $logbook['item']->get(), 'site') ?>
				<li data-item="<?=$logbook->get_nickname()?>">
					<?php
						$profilepic = (!$user['profilepic']->is_empty()) ? $user['profilepic']->unfold()[0]->thumbnail(100, null) : null;
					?>
					<div class="icon" data-item="human_<?=$user['owner'] ?>" data-item-link="timeline"><?=$profilepic?></div>
					
					<div class="padding">
					
						<ul class="thumbnails">
							<li>
								<div>
									<a href="http://" style="background-image:url('')"></a>
								</div>
							</li>
							<li>
								<div>
									<a href="http://"></a>
								</div>
							</li>
						</ul>

						<div class="title">
							
							<a href="<?=$user->edit() ?>" class="user"><?=$user['title'] ?></a>
							<?=cst('TIMELINE_EVENT_'.$event, $event)?>
							<?php if (!isset($_GET['item'])): ?><a href="<?=$structure->edit()?>"><?=count($items)?> <?=$structure['title'] ?></a> :<?php endif ?>
							
							<?php $i = $and = 0 ?>
							<?php foreach ($items as $item): ?>
								<?php $item = i($item['item']->get(), $item['itemid']->get(), $_SESSION['pref']['handled_env']) ?>

								<?php if (($item->exists()) && ($i < $displayItems)) : ?>
									<a href="<?= $item->edit()?>"><?= ($item['title']) ? $item['title'] : $item['key']; ?></a><?php if ($i != count($items)-1): ?>, <?php else : ?>.<?php endif ?>
								<?php else : $and++; endif ?>
								<?php $i++ ?>
							<?php endforeach ?>
							<?php if ($and > 0): ?>
								and <a href=""><?=$and?> others</a>.
							<?php endif ?>
						</div>
					
						<ul class="action">
							<li><a href="" class="notes">Discussion</a></li>
							<?php if ($event == 'update' && count($items) == 1): ?><li><a href="" class="compare">What's new</a></li><?php endif ?>
							<li class="icon-time"><?=$logbook['created']->time_since() ?></li>
						</ul>
					
						<div class="notes"></div>
											
					</div>
				</li>
			<?php endforeach ?>
		<?php endforeach ?>
	<?php endforeach ?>
<?php endforeach ?>
</ol>
<?php endif ?>
<?php/*=sentinel::stopwatch().'s ('.database::query_count().' queries), using '.sentinel::memoryusage()*/?>
<?php if (isset($EventSource)) : ?>
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
				if (data['label']) label = '<div class="title">'+data['label']+'</div>';
				
			//	LI
				li = '<li data-item="'+item+'" style="display:none"><div class="icon"></div><div class="padding">'+label+'</div></li>';
				$(li).prependTo('.logbookList').show('fast');
				
			//	No data ?
				if ($('.logbookList>li').length) $('.timeline>.nodata').hide();
			}
		}
	});
</script><?php endif ?>