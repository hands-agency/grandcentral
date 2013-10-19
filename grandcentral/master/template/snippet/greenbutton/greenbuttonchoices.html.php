<section id="greenbutton-choices">
	<ul>
		<? foreach ($actions as $action): ?>
		<li>
			<a data-action="<?=$action['key']?>">
				<span class="title"><?=cst('GREENBUTTON_CHOICES_'.$action['key'].'_TITLE', $action['title'])?></span>
				<span class="descr"><?=cst('GREENBUTTON_CHOICES_'.$action['key'].'_DESCR', $action['descr'])?></span>
			</a>
		</li>
		<? endforeach ?>
	</ul>
</section>