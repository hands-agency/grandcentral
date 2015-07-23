<?php foreach ($sections as $section): ?>
<li data-item="<?=$section->get_nickname()?>">
	
	<span class="handle" data-feathericon="&#xe026"></span>
	<button class="delete" type="button"></button>

	<div class="title"><span><span class="app"><?=$section['app']['app']?></span><?=$section['title']?></span></div>
	
	<div class="preview"><iframe></iframe></div>
	
	<input type="hidden" name="<?=$name?>[]" value="<?=$app['key']?>" disabled="disabled" />

</li>
<?php endforeach ?>