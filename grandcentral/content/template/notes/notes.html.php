<?php if (!isset($notes)) : ?>
<div class="nodata">We're building here a place where you'll be able to chat. Come back when you're work is done.</div>
<?php elseif (!$notes->count()): ?>
<div class="nodata">Something to say ?</div>
<?php endif ?>
<?php if (isset($notes)) : ?>
<ul class="noteList">
	<?php if ($displayNotes == $notes->count): ?><li class="more"></li><?php endif ?>

	<?php foreach ($notes as $note): ?>

	<?php
		if (isset($oldDate))
		{
			$currentDate = new dateTime($note['created']);
			$interval = $oldDate->diff($currentDate);

			if ($interval->format('%i') > $minuteDivider) {
				echo '</ul><h2><span class="rule">'.$note['created']->time_since().'</span></h2><ul class="noteList">';
			}
		}
		$oldDate = new dateTime($note['created']);
	?>

	<li data-item="note_<?= $note['id'] ?>">
	
		<div class="icon" data-item="human_<?= $note['owner'] ?>" data-item-link="timeline"></div>
	
		<div class="owner"><?= $note['owner'] ?></div>
	
		<div class="text"><?= $note['text'] ?></div>
	
	</li>
	<?php endforeach ?>
</ul>
<div class="noteForm">
	<div class="icon"></div>
	<?=$form?>
</div>
<?php endif ?>

<?php if (isset($EventSource)) : ?>
<script type="text/javascript" charset="utf-8">
//	Start source
	$.sse(
	{
		source:'<?=$EventSource?>&item=<?=$item?>',
		datetime:'<?=date('Y-m-d H:i:s')?>',
		onMessage:function(e)
		{
		//	Get the data
			data = JSON.parse(e.data);
			item = 'note_'+e.lastEventId;

		//	Delete loadings
			$('ul.noteList .loading').remove();
		//	Add content
			li = '<li data-item="'+item+'" style="display:none"><div class="icon" data-item="human_'+data['owner']+'" data-item-link="timeline"></div><div class="text">'+data['text']+'</div></li>';
			$(li).appendTo(list).slideDown('fast');
		//	No data ?
		//	nodata = list.prev('.nodata')
		//	if (list.find('li').length) nodata.hide();
		//	else nodata.show();
		}
	});
</script>
<?php endif ?>