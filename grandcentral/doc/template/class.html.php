<?php
	$class = $_PARAM['doc']->data;
	$methods = $class['method'];
//	Parent ?
	$parent = (isset($class['parent'])) ? '(parent of '.$class['parent'].')' : '';
?>
<header>
	<h1><?=$class['access'][0]?> class <?=$class['key']?> <?=$parent?></h1>
	<div class="descr">
		<?=$class['descr']?>
		<?php if (isset($class['link'])) : ?><p>More info: <a href="<?=$class['link'][0]?>"><?=$class['link'][0]?></a></p><?php endif; ?>
	</div>
</header>

<h3>Methods</h3>
<ul class="toc">
<?php foreach ($methods as $method): ?>
	<li><a href="#method_<?=$method['key']?>"><?=$method['key']?></a></li> 
<?php endforeach ?>
</ul>

<h3>Find it</h3>
<p>Written in <?=$class['file']?>. Starts line <?=$class['line']['start']?>, ends line <?=$class['line']['end']?> (that's <?=$class['line']['end']-$class['line']['start']?> lines of code)</p>
<?php if (isset($class['package'])) : ?><p>Package <?=$class['package'][0]?></p><?php endif; ?>

<?php if (isset($class['author'])) : ?>
<h3>Author(s)</h3>
<ul class="in2col">
<?php foreach($class['author'] as $email) : ?><li><?=$email?></li><?php endforeach; ?>
</ul>
<?php endif; ?>