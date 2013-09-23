<? if (!empty($available)) : ?>
<? foreach ($available as $li): ?>
<li data-item="<?=$li->get_nickname()?>">
	<button class="delete" type="button"></button>
	<div class="icon"></div>
	<div class="title"><?=$li['title']?></div>
	<? if (isset($li['descr'])): ?><div class="descr"><?=$li['descr']?></div><? endif ?>
</li>
<? endforeach ?>
<? endif ?>