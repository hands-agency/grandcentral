<?php foreach ($sections as $section): ?>
<li data-item="<?=$section->get_nickname()?>">
	
	<button class="delete" type="button"></button>

	<a class="title">
		<span><?=$section['title']?></span>
		<span class="app"><?=$section['app']['app']?></span>
	</a>
	
	<div class="preview"><iframe></iframe></div>
	
	<input type="hidden" name="<?=$name?>[]" value="<?=$section['key']?>" disabled="disabled" />

</li>
<?php endforeach ?>