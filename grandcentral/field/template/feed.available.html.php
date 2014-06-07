<? foreach ($attr as $li): ?>
<li class="">
	<button class="delete" type="button"></button>
	<div class="icon"></div>
	<div class="title"><?=$li['title']?></div>
	<?if (isset($li['descr'])): ?><div class="descr"><?=$li['descr']?></div><? endif ?>
	<input type="hidden" name="<?=$name?>[app]" value="<?=$li['key']?>" disabled="disabled" />
</li>
<? endforeach ?>