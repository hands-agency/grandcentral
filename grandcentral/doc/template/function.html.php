<?php
	$function = $_ITEM->data;
	for ($i=0; $i < count($function['param']) ; $i++) $arg[] = $function['param'][$i]['name'];
	$arg = implode(', ', $arg);
?>
<h2><?=$function['key']?></h2>
<p><?=$function['descr']?></p>

<h3>Syntax</h3>
<pre><?=$function['key']?>(<?=$arg?>);</pre>

<h3>Parameters</h3>
<table>
<? for ($i=0; $i < count($function['param']) ; $i++) : ?>
	<tr>
		<th><?=$function['param'][$i]['name']?></th>
		<td>
			<ul>
			<? foreach($function['param'][$i] as $param => $value) : ?>
				<li><strong><?=$param?></strong> : <?=$value?></li>
			<? endforeach; ?>
			</ul>
		</td>
	</tr>
<? endfor; ?>
</table>

<?php if (isset($function['return'])): ?>
<h3>Return</h3>
<p><?=$function['return'][0]?></p>
<?php endif ?>

<?php if (isset($function['access'])): ?>
<h3>Access</h3>
<p><?=$function['access'][0]?></p>
<?php endif ?>

<?php if (isset($function['author'])): ?>
<h3>Author(s)</h3>
<ul>
	<? foreach($function['author'] as $email) : ?><li><?=$email?></li><? endforeach; ?>
</ul>
<?php endif ?>

<h3>Find it</h3>
<p>Written in <?=$function['file']?></p>
<p>Starts line <?=$function['line']['start']?>, ends line <?=$function['line']['end']?> (that's <?=$function['line']['end']-$function['line']['start']?> lines of code)</p>

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