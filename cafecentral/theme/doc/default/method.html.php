<h2><?= $class ?>::<?=$method['key']?></h2>
<p><?=$method['descr']?></p>

<h3>Syntax</h3>
<pre>
$var = new <?= $class ?>();
$var-><?=$method['key']?>(<?=$arg?>);
</pre>

<h3>Parameters</h3>
<? if (isset($method['param'])): ?>
<table>
<? for ($i=0; $i < count($method['param']) ; $i++) : ?>
	<tr>
		<th><?=$method['param'][$i]['name']?></th>
		<td>
			<ul>
			<? foreach($method['param'][$i] as $param => $value) : ?>
				<li><strong><?=$param?></strong> : <?=$value?></li>
			<? endforeach; ?>
			</ul>
		</td>
	</tr>
<? endfor; ?>
</table>
<? else : ?>
<p>This method takes no parameters</p>
<?endif ?>

<?if (isset($method['return'])): ?>
<h3>Return</h3>
<p><?=$method['return'][0]?></p>
<?endif ?>

<?if (isset($method['access'])): ?>
<h3>Access</h3>
<p><?=$method['access'][0]?></p>
<?endif ?>

<?if (isset($method['author'])): ?>
<h3>Author(s)</h3>
<ul>
	<? foreach($method['author'] as $email) : ?><li><?=$email?></li><? endforeach; ?>
</ul>
<?endif ?>

<h3>Find it</h3>
<p>Written in <?=$method['file']?></p>
<p>Starts line <?=$method['line']['start']?>, ends line <?=$method['line']['end']?> (that's <?=$method['line']['end']-$method['line']['start']?> lines of code)</p>

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