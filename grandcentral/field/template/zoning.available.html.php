<? foreach ($available as $li): ?>
<li data-section="<?=$li['key']?>" data-app="<?=$li['app']['app']?>" data-template="<?=$li['app']['template']?>">
	<span class="handle" data-feathericon="&#xe026"></span>
	<button class="delete" type="button"></button>
	<div class="icon"></div>
	<div class="title"><span class="flag"><?=$li['app']['app']?></span><?=$li['title']?></div>
	<?if (isset($li['descr'])): ?><div class="descr"><?=$li['descr']?></div><? endif ?>
	<input type="hidden" name="<?=$name?>[app]" value="<?=$li['id']?>" disabled="disabled" />
</li>
<? endforeach ?>