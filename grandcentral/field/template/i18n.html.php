<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>

<div class="wrapper">
	<ul class="labels">
		<?php foreach ($r['data'] as $lang): ?>
		<?php
			$onOff = (!isset($onOff)) ? 'on' : 'off';
		?>
		<li class="<?=$onOff?>" data-lang="<?=$lang['lang']?>"><?=$lang['lang']?></li>
		<?php endforeach ?>
	</ul>
	<span class="field">
		<ul>
			<?php foreach ($fields as $field): ?>
			<?php
				$hide = (!isset($hide)) ? '' : 'style="display:none"';
				$lang = $r['data'][$i]['lang'];
				$i++;
			?>
			<li data-type="<?=$field->get_type()?>" data-lang="<?=$lang?>" <?=$hide?>><?= $field; ?></li>
			<?php endforeach ?>
		</ul>
	</span>
</div>
