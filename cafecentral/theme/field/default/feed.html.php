<input type="hidden" name="<?=$_ITEM->get_name()?>" value="" />
<div class="selected list">
	<div class="h3-wrapper"><h3>List</h3></div>
	<ol>
		<li class="nodata" <?=$hideNodataList?>>
			You should drop some fields here.
			<span class="cc-bubble">Here!</span>
		</li>
		<? foreach ($selectedList as $li): ?>
		<li data-item="<?=$li->get_nickname()?>">
			<button class="delete" type="button"></button>
			<div class="icon"></div>
			<div class="title"><?=$li['title']?></div>
			<?if (isset($li['descr'])): ?><div class="descr"><?=$li['descr']?></div><? endif ?>
		</li>
		<? endforeach ?>
	</ol>
</div>
<div class="available" data-name="<?=$name?>" data-values="<?=$values?>" data-valuestype="<?=$valuestype?>">
	<div class="h3-wrapper"><h3>Available</h3></div>
	<div class="refine"><input type="search" placeholder="Refine" /></div>
	<ul class="choices"><!-- Welcome Ajax --></ul>
</div>
<div class="selected detail">
	<div class="h3-wrapper"><h3>Detail</h3></div>
	<ol>
		<li class="nodata" <?=$hideNodataDetail?>>
			You should drop fields here too.
			<span class="cc-bubble">No, Here !</span>
		</li>
		<? foreach ($selectedDetail as $li): ?>
		<li data-item="<?=$li->get_nickname()?>">
			<button class="delete" type="button"></button>
			<div class="icon"></div>
			<div class="title"><?=$li['title']?></div>
			<?if (isset($li['descr'])): ?><div class="descr"><?=$li['descr']?></div><? endif ?>
		</li>
		<? endforeach ?>
	</ol>
</div>
<?=$name?>
<?=$values?>
<?=$valuestype?>
<div class="clear"><!-- Clearing floats --></div>