<?php foreach ($actions as $action): ?>
<?php
	if (isset($currentCat) && $currentCat != $action['cat']->get()) echo '</ul>';
	if (!isset($currentCat) OR $currentCat != $action['cat']->get()) echo '<ul class="greenbutton-choices"><li class="title"><span>'.$action['cat']->get().'</span></li>';
	
	$currentCat = $action['cat']->get();
	$and = null;
?>
	<li>
		<a data-action="<?=$action['key']?>" class="title"><?=$action['title']?></a>
		<?php if ($action['andback']->get() === true) $and .= '<a class="back" data-action="'.$action['key'].'_back"></a>'; ?>
		<?php if ($action['andreach']->get() === true) $and .= '<a class="reach" data-action="'.$action['key'].'_reach"></a>'; ?>
		<?php if ($and) echo '<div class="and">'.$and.'</div>'; ?>
	</li>
<?php endforeach ?>