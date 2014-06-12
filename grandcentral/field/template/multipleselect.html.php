<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<div class="field">
		<input  type="hidden" name="<?= $_FIELD->get_name(); ?>" <?php if ($_FIELD->is_disabled()): ?>disabled="disabled"<?php endif ?>value="">
		<div class="selected">
			<ol data-nodata="<?= cst('MULTIPLESELECT_SELECTED_NODATA');?>"><? foreach ($selected as $li): ?>
				<li>
					<span class="handle" data-feathericon="&#xe026"></span>
					<button class="delete" type="button"></button>
					<div class="icon"></div>
					<div class="title"><?=$li['title']?></div>
					<input type="hidden" name="<?=$_FIELD->get_name()?>[]" value="<?=$li->get_nickname()?>" />
				</li>
				<? endforeach ?></ol>
		</div>
		<div class="available" data-name="<?=$name?>" data-values="<?=$values?>" data-valuestype="<?=$valuestype?>">
			<div class="refine"><input type="search" placeholder="Refine" /></div>
			<ul class="choices"><!-- Welcome Ajax --></ul>
		</div>
		<div class="clear"><!-- Clearing floats --></div>
	</div>
</div>