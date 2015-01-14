<h2>[classname]::<?=$method['key']?></h2>
<p><?=$method['descr']?></p>

<h3>Syntax</h3>
<pre>
$var = new [classname]();
$var-><?=$method['key']?>(<?=$arg?>);
</pre>

<h3>Arguments</h3>
<?php if (isset($method['param'])): ?>
<table>
<?php for ($i=0; $i < count($method['param']) ; $i++) : ?>
	<tr>
		<th><?=$method['param'][$i]['name']?></th>
		<td>
			<ul>
			<?php foreach($method['param'][$i] as $param => $value) : ?>
				<li><strong><?=$param?></strong> : <?=$value?></li>
			<?php endforeach; ?>
			</ul>
		</td>
	</tr>
<?php endfor; ?>
</table>	
<?php else: ?>
<p>This method takes no arguments</p>
<?php endif ?>

<?php if (isset($method['return'])): ?>
<h3>Return</h3>
<p><?=$method['return'][0]?></p>
<?php endif ?>

<?php if (isset($method['access'])): ?>
<h3>Access</h3>
<p><?=$method['access'][0]?></p>
<?php endif ?>

<?php if (isset($method['author'])): ?>
<h3>Author(s)</h3>
<ul>
	<?php foreach($method['author'] as $email) : ?><li><?=$email?></li><?php endforeach; ?>
</ul>
<?php endif ?>

<h3>Find it</h3>
<p>Written in <?=$method['file']?></p>
<p>Starts line <?=$method['line']['start']?>, ends line <?=$method['line']['end']?> (that's <?=$method['line']['end']-$method['line']['start']?> lines of code)</p>
