<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>
<div class="wrapper">
	<?php if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr() ?></div><?php endif ?>
	<div class="field">
		
		<div class="type">
			<ol>
				<li data-key="key" data-type="radio"><?= $fieldKey ?></li>
			</ol>
		</div>
		
		<div class="option">
			<ol>
				<li data-key="http-status" data-type="select"><?= $fieldHttpStatus ?></li>
				<li data-key="content-type" data-type="select"><?= $fieldContentType ?></li>
				<li data-key="url" data-type="url"><?= $fieldUrl ?></li>
				<li data-key="master" data-type="app"><?= $fieldMaster ?></li>
			</ol>
		</div>
		
	</div>
</div>