<script type="text/javascript" charset="utf-8">
	$('#context #sirtrevorlink .external button').on('click', function()
	{
		link = $(this).parent().find('input').val()
		if(link && link.length > 0)
		{
			link_regex = /(ftp|http|https):\/\/./;
			if (!link_regex.test(link)) link = "http://" + link;
			document.execCommand('CreateLink', false, link);
			closeContext();
		}
		else console.log('That is not a valid URL, buddy');
	});
	$('#context #sirtrevorlink .internal [data-item] button').on('click', function()
	{
		link = $(this).parent().data('item');
		document.execCommand('CreateLink', false, link);
		closeContext();
	});
</script>

<div id="sirtrevorlink">
	<div class="external">
		<iframe src=""><input type="url" placeholder="An external URL" /><button>go</button></iframe>
	</div>
	<div class="internal">
		<?php foreach ($structures as $structure): ?>
			<h1><?=$structure['title']?></h1>
			<?
				$items = i($structure['key']->get(), array('order()' => 'title'), 'site');
			?>
			<ul>
			<?php foreach ($items as $item): ?>
				<li data-item="<?=$item->get_nickname()?>"><button><?=$item['title']?></button></li>
			<?php endforeach ?>
			</ul>
		<?php endforeach ?>
	</div>
</div>