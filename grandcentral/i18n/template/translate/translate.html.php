<h1>Translate content</h1>
<div id="translate">
	<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
		<ul id="toc">
			<?php foreach ($tocItems as $item): ?>
			<?php
				$class = ($item['key'] == $_POST['item']) ? 'on' : null;
			?>
			<li class="<?=$class?>"><a data-item="<?=$item['key']?>"><?=$item['title']?></a></li>
			<?php endforeach ?>
		</ul>
	</div>
	
	<?php if (empty($forms)): ?>
	<div data-nodata="Nothing to translate here" class="col-xs-12 col-sm-8 col-md-9 col-lg-10"></div>
	<?php else: ?>
	<?php foreach ($forms as $key => $items): ?>
	<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
		<?php foreach ($items as $item): ?>
			<h3><span><?=$item['item']['key']?></span><?=$item['item']['title']?></h3>
			<?=$item['form']?>
		<?php endforeach ?>
	</div>
	<?php endforeach ?>	
	<?php endif ?>
</div>

<?php
//	Binds are here because we need the ressources of the form template first
	$_APP->bind_css('translate/css/translate.css');
	$_APP->bind_script('translate/js/translate.js');
?>