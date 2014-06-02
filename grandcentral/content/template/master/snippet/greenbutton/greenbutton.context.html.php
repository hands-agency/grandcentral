<h1>More actions</h1>
<ul id="greenbutton-choices">
	<? foreach ($actions as $action): ?>
	<li>
		<a data-action="<?=$action['key']?>" class="title">
			<?=$action['title']?>
		</a>
	</li>
	<? endforeach ?>
</ul>