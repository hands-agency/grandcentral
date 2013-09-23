<?
//	Some vars
	$class = $_ITEM->data;
	$methods = $class['method'];
//	Has a parent class ?
	$parent = (isset($class['parent'])) ? '(parent of '.$class['parent'].')' : null;
?>
<h2><?=$class['access'][0]?> class <em><?=$class['key']?></em> <?=$parent?></h2>
<p><?= text::deduplicate_br($class['descr']) ?></p>
<? if (isset($class['link'])) : ?><p>More info: <a href="<?=$class['link'][0]?>"><?=$class['link'][0]?></a></p><? endif; ?>

<h3>Methods</h3>
<ul class="toc">
<?php foreach ($methods as $method): ?>
	<li><a href="?method=<?=$class['key']?>::<?=$method['key']?>#doc"><?=$method['key']?></a></li> 
<?php endforeach ?>
</ul>

<h3>What we're looking at</h3>
<ul>
	<li>You'll find it in <?=$class['file']?></li>
	<li>Starts line <?=$class['line']['start']?>, ends line <?=$class['line']['end']?> that's <?=$class['line']['end']-$class['line']['start']?> lines of code)</li>
	<li>Package <?=$class['package'][0]?></li>
</ul>

<h3>Author(s)</h3>
<ul class="in2col">
<? foreach($class['author'] as $email) : ?><li><?=$email?></li><? endforeach; ?>
</ul>

<h3>Comments</h3>
<p>Please note that these comments will be shared with the whole Café Central Community, not just your company.</p>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=171899362895002";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="http://www.cafecentral.fr" data-num-posts="10" data-width="570"></div>