<?php if (!isset($items)): ?>
<div class="nodata">There are no item to translate.</div>
<?php else: ?>
<h1>Translate content</h1>
<?php foreach ($forms as $key => $items): ?>
	
	<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
		<ul id="toc">
			<?php foreach ($tocItems as $item): ?>
			<?
				$class = ($item['key'] == $key) ? 'on' : null;
			?>
			<li class="<?=$class?>"><a data-item="<?=$item['key']?>"><?=$item['title']?></a></li>
			<?php endforeach ?>
		</ul>
	</div>
	
	<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
	<?php foreach ($items as $item): ?>
		<h3><span><?=$item['item']['key']?></span><?=$item['item']['title']?></h3>
		<?=$item['form']?>
	<?php endforeach ?>
	</div>
<?php endforeach ?>
<?php endif ?>
<?php
//	Binds are here because we need the ressources of the form template first
	$_APP->bind_css('openlabs/i18n/css/i18n.css');
	$_APP->bind_script('openlabs/i18n/js/i18n.js');
?>