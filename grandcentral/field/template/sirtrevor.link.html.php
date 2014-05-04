<script type="text/javascript" charset="utf-8">
//	External link
	$(document).on('click', '#adminContext #sirtrevorlink .external button', function()
	{
		link = $('#externalLink').contents().find('input').val();
		if(link && link.length > 0)
		{
			link_regex = /(ftp|http|https):\/\/./;
			if (!link_regex.test(link)) link = "http://" + link;
			document.execCommand('CreateLink', false, link);
			closeContext();
		}
		else console.log('That is not a valid URL, buddy');
	});
//	Internal link
	$(document).on('click', '#adminContext #sirtrevorlink .internal [data-item] button', function()
	{
		link = $(this).parent().data('item');
		document.execCommand('CreateLink', false, link);
		closeContext();
	});
</script>

<div id="sirtrevorlink">
	<div class="external">
		<!-- Stored in an iframe to keep the focus on the highlighted link...-->
		<iframe id="externalLink" src="http://localhost/link.html"></iframe>
		<button>Add link</button>
	</div>
	<div class="internal">
		<?php foreach ($items as $structure): ?>
			<h2><span class="centered"><?=$structure['title']?></span></h2>
			<?
				$items = i($structure['key']->get(), array('order()' => 'title'), 'site');
			?>
			<ul>
			<?php foreach ($items as $item): ?>
				<li data-item="<?=$item['url']->abbr()?>"><button><?=$item['title']?></button></li>
			<?php endforeach ?>
			</ul>
		<?php endforeach ?>
	</div>
</div>