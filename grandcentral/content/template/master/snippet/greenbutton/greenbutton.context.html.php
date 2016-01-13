<h1>Options</h1>
<?php foreach ($actions as $action): ?>
<?php
	if (isset($currentCat) && $currentCat != $action['cat']->get()) echo '</ul>';
	if (!isset($currentCat) OR $currentCat != $action['cat']->get()) echo '<ul class="greenbutton-choices"><li class="title"><span>'.$action['cat']->get().'</span></li>';
	
	$currentCat = $action['cat']->get();
	$and = null;
?>
	<li>
		<div class="wrapper" <?php if (isset($action['color'])): ?>style="background-color:#<?=$action['color']?>"<?php endif ?>>
			<a data-action="<?=$action['key']?>">
				<i data-feathericon="<?=$action['icon']->get()?>"></i>
				<span class="title"><?=$action['title']?></span>
			</a>
			<?php if (isset($action['andback']) && $action['andback']->get() === true) $and .= '<a class="back" data-action="'.$action['key'].'_back"></a>'; ?>
			<?php if (isset($action['andreach']) && $action['andreach']->get() === true) $and .= '<a class="reach" data-action="'.$action['key'].'_reach"></a>'; ?>
			<?php if (isset($action['andnew']) && $action['andnew']->get() === true) $and .= '<a class="new" data-action="'.$action['key'].'_new"></a>'; ?>
			<?php if ($and) echo '<div class="and">'.$and.'</div>'; ?>
		</div>
	</li>
<?php endforeach ?>