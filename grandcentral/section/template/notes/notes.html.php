<? if (!isset($notes)) : ?>
<div class="nodata">We're building here a place where you'll be able to chat. Come back when you're work is done.</div>
<? elseif (!$notes->count()): ?>
<div class="nodata">Do you have something to say ?</div>
<? endif ?>
<? if (isset($notes)) : ?>
<ul class="noteList">
	<? if ($displayNotes == $notes->count): ?><li class="more"></li><? endif ?>
	
	<? foreach ($notes as $note): ?>

	<? if ($note['created']) : ?>
	<!--li class="divider"><h2>Divider</h2></li-->
	<? endif ?>
	
	<li data-item="note_<?= $note['id'] ?>">
		
		<div class="icon medium icon-user"></div>
		
		<? $author = $note->get_rel('author', array('limit()' => 1))[0] ?>
		<div class="author"><a href="<?=$author->edit()?>"><?=$author['title']?></a></div>
		
		<div class="descr"><?= $note['descr'] ?></div>

		<? $date = new date($note['created']); ?>
		<ul class="date"><?=$date->time_since() ?></ul>
		
	</li>
	<? endforeach ?>
</ul>
<div class="noteForm">
	<div class="icon medium icon-user"></div>
	<?=$form?>
</div>
<? endif ?>

<? if (isset($EventSource)) : ?>
<script type="text/javascript" charset="utf-8">
//	Start event source only when you're told to
	StartEventSource = function(list, item, itemid)
	{
	//	Start source
		source = $.sse(
		{
			source:'<?=$EventSource?>&item='+item+'&itemid='+itemid,
			datetime:'<?=date('Y-m-d H:i:s')?>',
			onMessage:function(e)
			{
			//	Get the data
				data = JSON.parse(e.data);
				item = data['item']+'_'+e.lastEventId;

			//	Ensure the items get loaded just one time
				if (list.find('li[data-item='+item+']').length == 0)
				{
				//	Delete loadings
					list.find('.loading').remove();
				//	Add content
					author = '<div class="author"><a href="'+data['author_link']+'">'+data['author_name']+'</a></div>';
					li = '<li data-item="'+item+'" style="display:none"><div class="icon medium icon-user"></div>'+author+'<div class="descr">'+data['descr']+'</div><div class="date">'+data['created']+'</div></li>';
					$(li).appendTo(list).slideDown('fast');
				//	No data ?
					nodata = list.prev('.nodata')
					if (list.find('li').length) nodata.hide();
					else nodata.show();
				}
			}
		});
	}
</script>
<? endif ?>