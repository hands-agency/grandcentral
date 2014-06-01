<h1>Or...</h1>
<ul>
	<? foreach ($actions as $action): ?>
	<li>
		<a data-action="<?=$action['key']?>" class="title">
			<?=$action['title']?>
		</a>
	</li>
	<? endforeach ?>
</ul>