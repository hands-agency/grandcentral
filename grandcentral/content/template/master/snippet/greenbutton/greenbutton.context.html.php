<?php foreach ($actions as $action): ?>
<?php
	if (isset($currentCat) && $currentCat != $action['cat']->get()) echo '</ul>';
	if (!isset($currentCat) OR $currentCat != $action['cat']->get()) echo '<ul class="greenbutton-choices"><li class="title"><span>'.$action['cat']->get().'</span></li>';
	
	$currentCat = $action['cat']->get()
?>
	<li>
		<a data-action="<?=$action['key']?>" class="title">
			<?=$action['title']?>
		</a>
	</li>
<?php endforeach ?>