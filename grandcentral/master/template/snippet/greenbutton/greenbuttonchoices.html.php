<section id="greenbutton-choices">
	<ul>
		<? foreach ($actions as $action): ?>
		<li>
			<a data-action="<?=$action['key']?>" class="title">
				<?=cst('GREENBUTTON_CHOICES_'.$action['key'].'_TITLE', $action['title'])?>
			</a>
			<span class="descr"><?=cst('GREENBUTTON_CHOICES_'.$action['key'].'_DESCR', $action['descr'])?></span>
		</li>
		<? endforeach ?>
	</ul>
</section>