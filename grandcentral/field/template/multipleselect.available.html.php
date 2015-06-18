<?php if (!empty($available)) : ?>
<?php foreach ($available as $li): ?>
<li data-item="<?=$li['id']?>">	
	<button class="delete" type="button"></button>
	<div class="icon"></div>
	<div class="title"><a><?=$li['title']?></a></div>
</li>
<?php endforeach ?>
<?php endif ?>