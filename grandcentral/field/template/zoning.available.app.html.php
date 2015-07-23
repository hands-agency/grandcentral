<?php foreach ($apps as $app): ?>
<?php
/*
//	App
	$app = (isset($section['app']['app']) & !empty($section['app']['app'])) ? $section['app']['app'] : null;
//	template
	$template = (isset($section['app']['template']) & !empty($section['app']['template'])) ? $section['app']['template'] : null;
//	param
	$param = (isset($section['app']['param']) & !empty($section['app']['param'])) ? htmlspecialchars(json_encode($section['app']['param']), ENT_COMPAT, 'UTF-8') : null;
	*/
?>
<li data-app="<?=$app['key']?>">
	
	<button class="delete" type="button"></button>
	
	<div class="title"><span><span class="flag"><?=$app['title']?></span></span></div>
	
	<div class="preview"><iframe src=""></iframe></div>
	
	<input type="hidden" name="<?=$name?>[]" value="<?=$app['key']?>" disabled="disabled" />

</li>
<?php endforeach ?>