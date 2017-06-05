<?php if (!empty($available)) : ?>
<?php foreach ($available as $li): ?>
<li data-item="<?=$li['id']?>" data-status="<?=$li['status']?>">
	<button class="delete" type="button"></button>
	<div class="icon"></div>

	<span class="title"><?=$li['title']?></span>

	<input type="hidden" name="<?=$name?>[]" value="<?=$li['id']?>" disabled="disabled" />

</li>
<?php endforeach ?>
<?php endif ?>
