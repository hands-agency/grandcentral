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