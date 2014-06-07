<div class="selected list">
	<p>Displayed in the list</p>
	<ol>
		<li class="nodata" <?=$hideNodataList?>>
			You should drop some fields here.
			<span class="cc-bubble">Here!</span>
		</li>
		<? foreach ($selectedList as $li): ?>
		<li class="">
			<button class="delete" type="button"></button>
			<div class="icon"></div>
			<div class="title"><?=$li['title']?></div>
			<?if (isset($li['descr'])): ?><div class="descr"><?=$li['descr']?></div><? endif ?>
			<input type="hidden" name="<?=$_APP->get_name()?>[]" value="<?=$li->get_nickname()?>" />
		</li>
		<? endforeach ?>
	</ol>
</div>
<div class="available">
	<p>Available</p>
	<div class="refine"><input type="search" placeholder="Refine" /></div>
	<ul class="choices"><!-- Welcome Ajax --></ul>
</div>
<div class="selected detail">
	<p>Displayed in the detail
	</p>
	<ol>
		<li class="nodata" <?=$hideNodataDetail?>>
			You should drop fields here too.
			<span class="cc-bubble">No, Here !</span>
		</li>
		<? foreach ($selectedDetail as $li): ?>
		<li class="">
			<button class="delete" type="button"></button>
			<div class="icon"></div>
			<div class="title"><?=$li['title']?></div>
			<?if (isset($li['descr'])): ?><div class="descr"><?=$li['descr']?></div><? endif ?>
			<input type="hidden" name="<?=$_APP->get_name()?>[]" value="<?=$li->get_nickname()?>" />
		</li>
		<? endforeach ?>
	</ol>
</div>
<?=$name?>
<?=$values?>
<?=$valuestype?>
<div class="clear"><!-- Clearing floats --></div>