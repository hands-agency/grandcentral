<div class="detail">
	<?php if (isset($thumbnail)): ?>
	<div class="preview" data-path="<?=$file->get_path()?>" data-url="<?=$file->get_url()?>" data-info="<?= $file->get_extension() ?> • <?= $file->get_size() ?>" data-title="<?= $file->get_key() ?>"><?= $thumbnail; ?></div>
	<?php endif ?>
	<h2><span class="rule">About</span></h2>
	<table class="about">
		<tr>
			<td>File</td>
			<td><?= $key; ?></td>
		</tr>
		<tr>
			<td>Url</td>
			<td><?= $url; ?></td>
		</tr>
		<tr>
			<td>Type</td>
			<td><?= $type; ?></td>
		</tr>
		<?php if (isset($dimensions)) : ?>
		<tr>
			<td>Dimensions</td>
			<td><?= $dimensions['width'] ?> x <?= $dimensions['height'] ?></td>
		</tr>
		<?php endif ?>
		<tr>
			<td>Size</td>
			<td><?= $size; ?></td>
		</tr>
		<tr>
			<td>Created</td>
			<td><?= $created; ?></td>
		</tr>
		<tr>
			<td>Updated</td>
			<td><?= $updated; ?></td>
		</tr>
	</table>
</div>
<div class="button-group">
	<button type="button" name="delete" data-path="<?=$file->get_path()?>" data-title="<?= $file->get_key() ?>">Delete</button>
</div>
