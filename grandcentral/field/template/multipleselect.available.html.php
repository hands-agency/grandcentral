<? if (!empty($available)) : ?>
<? foreach ($available as $li): ?>
<li data-item="<?=$li['id']?>">	
	<span class="handle" data-feathericon="&#xe026"></span>
	<button class="delete" type="button"></button>
	<div class="icon"></div>
	<div class="title"><?=$li['title']?></div>
</li>
<? endforeach ?>
<? endif ?>