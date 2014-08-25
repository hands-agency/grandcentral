<label for="<?= $_FIELD->get_name(); ?>">
	<?= $_FIELD->get_label(); ?>
	<span class="help"></span>
</label>

<div class="wrapper">
	<?php if ($_FIELD->get_descr() != null) : ?><div class="help"><?= $_FIELD->get_descr(); ?></div><?php endif ?>
		
	<ul class="level"><?= $radioLevel ?></ul>
	
	<span class="field">
		<ul class="data">
			<?= $data; ?>
			<li class="add">+</li>
		</ul>
	</span>

	<pre class="template">
		<?=$template; ?>
	</pre>
</div>