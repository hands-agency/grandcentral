<?php foreach ($sections as $section): ?>
<li data-item="<?=$section->get_nickname()?>">
	
	<button class="delete" type="button"></button>

	<div class="title">
		<a>
			<span><?=$section['title']?></span>
			<span class="app"><?=$section['app']['app']?></span>
		</a>
	</div>
	
	<div class="preview"><iframe></iframe></div>
	
	<input type="hidden" name="<?=$name?>[]" value="<?=$app['key']?>" disabled="disabled" />

</li>
<?php endforeach ?>