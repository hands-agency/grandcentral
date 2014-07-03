<div class="detail" data-path="<?=$file->get_path()?>" data-info="<?= $file->get_extension() ?> • <?= $file->get_size() ?>" data-title="<?= $file->get_key() ?>">
	<? if (isset($thumbnail)): ?>
	<div class="preview"><?= $thumbnail; ?></div>
	<? endif ?>

	<h2><span class="centered">About</span></h2>
	<table class="about">
		<tr>
			<td>File</td>
			<td><?= $key; ?></td>
		</tr>
		<tr>
			<td>Root</td>
			<td><?= $root; ?></td>
		</tr>
		<tr>
			<td>Url</td>
			<td><?= $url; ?></td>
		</tr>
		<tr>
			<td>Type</td>
			<td><?= $type; ?></td>
		</tr>
		<? if (isset($dimensions)) : ?>
		<tr>
			<td>Dimensions</td>
			<td><?= $dimensions['width'] ?> x <?= $dimensions['height'] ?></td>
		</tr>
		<? endif ?>
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
	<button type="button" class="back">⇠ Back</button>
</div>