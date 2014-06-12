<? foreach ($available as $li): ?>
<li class="">
	<span class="handle" data-feathericon="&#xe026"></span>
	<button class="delete" type="button"></button>
	<div class="icon"></div>
	<div class="title"><span class="flag"><?=$li['app']['app']?></span><?=$li['title']?></div>
	<?if (isset($li['descr'])): ?><div class="descr"><?=$li['descr']?></div><? endif ?>
	<input type="hidden" name="<?=$name?>[app]" value="<?=$li['id']?>" disabled="disabled" />
</li>
<? endforeach ?>