<?php foreach ($sections as $section): ?>
<li data-item="<?=$section->get_nickname()?>">
	
	<span class="handle" data-feathericon="&#xe026"></span>
	<button class="delete" type="button"></button>

	<div class="title"><span><span class="app"><?=$section['app']['app']?></span><?=$section['title']?></span></div>
	
	<div class="preview"><iframe></iframe></div>

</li>
<?php endforeach ?>