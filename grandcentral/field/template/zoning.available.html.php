<?php foreach ($available as $li): ?>
<li data-section="<?=$li['key']?>" data-app="<?=$li['app']['app']?>" data-template="<?=$li['app']['template']?>">
	<span class="handle" data-feathericon="&#xe026"></span>
	<button class="delete" type="button"></button>
	<div class="icon"></div>
	<div class="title"><span class="flag"><?=$li['app']['app']?></span><?=$li['title']?></div>
	<?phpif (isset($li['descr'])): ?><div class="descr"><?=$li['descr']?></div><?php endif ?>
	<input type="hidden" name="<?=$name?>[app]" value="<?=$li['id']?>" disabled="disabled" />
	
	<span class="configure">
		<?php
		//	template
			$template = (isset($li['app']['template']) & !empty($li['app']['template'])) ? $li['app']['template'] : null;
		//	param
			$param = (isset($li['app']['param']) & !empty($li['app']['param'])) ? htmlspecialchars(json_encode($li['app']['param']), ENT_COMPAT, 'UTF-8') : null;
		?>
		<span class="template">
		<?php if ($template): ?>
		<input type="hidden" name="<?= $name; ?>[template]" value="<?=$template?>" />
		<?php endif ?>
		</span>
		<span class="param">
		<?php if ($param): ?>
		<?php foreach ($li['app']['param'] as $key => $value): ?>
			<?php if (!is_array($value)): ?>
			<textarea style="display:none" name="<?= $name; ?>[param][<?=$key?>]"><?=$value?></textarea>
			<?php else: ?>
			<?php foreach ($value as $k => $v): ?>
			<textarea style="display:none" name="<?= $name; ?>[param][<?=$key?>][<?=$k?>]"><?=$v?></textarea>
			<?php endforeach ?>
			<?php endif ?>
		<?php endforeach ?>
		<?php endif ?>
		</span>
	</span>

</li>
<?php endforeach ?>