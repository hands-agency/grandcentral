<?php if ($templates): ?>
<div class="template">
	<h1>Templates</h1>
	<?= $fieldTemplate; ?>
</div>
<?php endif ?>

<div class="param">
	<h1>Params</h1>
	<form>
		<fieldset>
			<ol>
			<?php foreach ($fields as $field) : ?>
				<li data-type="<?= $field->get_type(); ?>" data-key="<?= $field->get_key(); ?>"><?= $field; ?></li>
			<?php endforeach; ?>
			</ol>
		</fieldset>
	</form>
</div>

<button class="done" data-feathericon="&#xe094"> Done</button>