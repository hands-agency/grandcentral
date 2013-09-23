<div>
	<ul>
<? foreach($_item as $item): ?>
<?='<li>'.n?>
<? foreach($item as $key => $value): ?>
<? if (!empty($value)): ?><?=t?><div class="<?=$key?>"><?=$value?></div><?=n;endif; ?>
<? endforeach; ?>
<?='</li>'.n?>
<? endforeach; ?>
	</ul>
</div>