<?php if (isset($item['title'])): ?>
<header>
	<div class="cover" <?php if (isset($coverField) && !$item[$coverField]->is_empty()): ?>style="background-image:url('<?=media($item[$coverField][0]['url'])->get_url()?>')"<?php endif ?>></div>
	<?php if (isset($item['title'])): ?><h1><?=$item['title']->cut('55')?></h1><?php endif ?>
</header>
<?php endif ?>

<?= $form; ?>

<?php if (isset($_POST['greenbutton'])): ?>
<ul class="greenbutton-choices">
	<li class="title"><span>︿</span></li>
	<?php foreach ($greenbuttons as $greenbutton): ?>	
	<li>
		<div class="wrapper" <?php if (isset($greenbutton['color'])): ?>style="background-color:#<?=$greenbutton['color']?>"<?php endif ?>>
			<a data-action="<?=$greenbutton['key']?>">
				<i data-feathericon="<?=$greenbutton['icon']->get()?>"></i>
				<span class="title"><?=$greenbutton['title']?></span>
			</a>
		</div>
	</li>
	<?php endforeach ?>
</ul>
<?php endif ?>