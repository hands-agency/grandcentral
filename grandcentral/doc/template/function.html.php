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
<?php for ($i=0; $i < count($function['param']) ; $i++) : ?>
	<tr>
		<th><?=$function['param'][$i]['name']?></th>
		<td>
			<ul>
			<?php foreach($function['param'][$i] as $param => $value) : ?>
				<li><strong><?=$param?></strong> : <?=$value?></li>
			<?php endforeach; ?>
			</ul>
		</td>
	</tr>
<?php endfor; ?>
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
	<?php foreach($function['author'] as $email) : ?><li><?=$email?></li><?php endforeach; ?>
</ul>
<?php endif ?>

<h3>Find it</h3>
<p>Written in <?=$function['file']?></p>
<p>Starts line <?=$function['line']['start']?>, ends line <?=$function['line']['end']?> (that's <?=$function['line']['end']-$function['line']['start']?> lines of code)</p>
