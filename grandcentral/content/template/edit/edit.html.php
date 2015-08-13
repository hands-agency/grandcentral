<header>
	<div class="cover" <?php if (isset($coverField) && !$item[$coverField]->is_empty()): ?>style="background-image:url('<?=media($item[$coverField][0]['url'])->get_url()?>')"<?php endif ?>></div>
	<h1><?=$item['title']->cut('55')?></h1>
	<?php if (isset($item['descr'])): ?><div class="descr"><?=$item['descr']?></div><?php endif ?>
</header>

<?= $form; ?>

<?php if (isset($_POST['greenbutton'])): ?>
<ul class="greenbutton-choices">
	<li class="title"><span>Done</span></li>
	<?php foreach ($greenbuttons as $greenbutton): ?>	
	<li>
		<a data-action="<?=$greenbutton['key']?>" class="title"><?=$greenbutton['title']?></a>
	</li>
	<?php endforeach ?>
</ul>
<?php endif ?>