<input type="hidden" name="<?=$_ITEM->get_name()?>" value="" />
<div class="selected">
	<div class="h3-wrapper"><h3><?=MULTIPLESELECT_SELECTED_LABEL?></h3></div>
	<ol>
		<li class="nodata" <?=$hideNodata?>>
			<?=MULTIPLESELECT_SELECTED_NODATA?>
			<span class="cc-bubble warning">Here!</span>
		</li>
		<? foreach ($selected as $li): ?>
		<li class="">
			<button class="delete" type="button"></button>
			<div class="icon"></div>
			<div class="title"><?=$li['title']?></div>
			<?if (isset($li['descr'])): ?><div class="descr"><?=$li['descr']?></div><? endif ?>
			<input type="hidden" name="<?=$_ITEM->get_name()?>[]" value="<?=$li->get_nickname()?>" />
		</li>
		<? endforeach ?>
	</ol>
</div>
<div class="available" data-name="<?=$name?>" data-values="<?=$values?>" data-valuestype="<?=$valuestype?>">
	<div class="h3-wrapper"><h3><?=MULTIPLESELECT_AVAILABLE_LABEL?></h3></div>
	<div class="refine"><input type="search" placeholder="Refine" /></div>
	<ul class="choices"><!-- Welcome Ajax --></ul>
</div>
<div class="clear"><!-- Clearing floats --></div>