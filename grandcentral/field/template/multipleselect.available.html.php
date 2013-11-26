<? if (!empty($available)) : ?>
<? foreach ($available as $li): ?>
<li data-item="<?=$li['id']?>">
	<button class="delete" type="button"></button>
	<div class="icon"></div>
	<div class="title"><?=$li['title']?></div>
</li>
<? endforeach ?>
<? endif ?>