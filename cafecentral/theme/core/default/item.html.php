<div id="<?= $_ITEM->get_table().'_'.$_ITEM['key'] ?>">
	<? foreach($_ITEM as $key => $value): ?>
	<? if (!empty($value) && !is_Array($value) && gettype($value) != "item"): ?><?=t?><div class="<?=$key?>"><?=$value?></div><?=n?><? endif; ?>
	<? endforeach; ?>
</div>