<? if (!isset($versions)): ?>
<div class="nodata">There are no const to translate.</div>
<? else: ?>
<h1>Translate constants</h1>
<table>
	<tr>
		<th>key</th>
		<?php foreach ($versions as $version): ?>
		<th><?=$version['title']?></th>
		<?php endforeach ?>
	</tr>
	<?php foreach ($consts[$defaultVersion] as $const): ?>
	<tr>
		<td><?=$const['key']?></td>
		<?php foreach ($versions as $version): ?>
		<td><input type="text" name="" value="<?=$consts[$version['key']->get()]['const_'.$const['key']->get()]['title']?>"></td>
		<?php endforeach ?>
	</tr>
	<?php endforeach ?>
</table>
<?php endif ?>