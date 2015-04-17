<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<?php if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr() ?></div><?php endif ?>
	<div class="field" data-name="<?= $_FIELD->get_name(); ?>" data-env="<?= $_SESSION['pref']['handled_env']; ?>">
	
		<?= $field; ?>
		<button type="button"><?=$cfgButtonLabel?></button>
		
		<span class="configure">
			<span class="template">
			<?php if ($template): ?>
			<input type="hidden" name="<?= $_FIELD->get_name(); ?>[template]" value="<?=$template?>" />
			<?php endif ?>
			</span>
			<span class="param">
			<?php if ($param): ?>
			<?php foreach ($value['param'] as $key => $value): ?>
				<?php if (!is_array($value)): ?>
				<textarea style="display:none" name="<?= $_FIELD->get_name(); ?>[param][<?=$key?>]"><?=$value?></textarea>
				<?php else: ?>
				<?php foreach ($value as $k => $v): ?>
					<?php if (!is_array($v)): ?>
					<textarea style="display:none" name="<?= $_FIELD->get_name(); ?>[param][<?=$key?>][<?=$k?>]"><?=$v?></textarea>
					<?php else: ?>
					<?php foreach ($v as $kk => $vv): ?>
					<textarea style="display:none" name="<?= $_FIELD->get_name(); ?>[param][<?=$key?>][<?=$k?>][<?=$kk?>]"><?=$vv?></textarea>
					<?php endforeach ?>
					<?php endif ?>
				<?php endforeach ?>
				<?php endif ?>
			<?php endforeach ?>
			<?php endif ?>
			</span>
		</span>
	
	</div>
</div>