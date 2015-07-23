<?php if (!empty($available)) : ?>
<?php foreach ($available as $li): ?>
<li data-item="<?=$li['id']?>">	
	<span class="handle" data-feathericon="&#xe026"></span>
	<button class="delete" type="button"></button>
	<div class="icon"></div>
	<div class="title"><?=$li['title']?></div>
	<input type="hidden" name="<?=$name?>[]" value="<?=$li['id']?>" disabled="disabled" />
</li>
<?php endforeach ?>
<?php endif ?>
<li class="add"></li>