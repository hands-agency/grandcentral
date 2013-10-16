<section id="greenbuttonchoices">
	<ul>
		<? foreach ($actions as $action): ?>
		<li>
			<div class="title"><?=cst('GREENBUTTON_CHOICES_'.$action['key'].'_TITLE', $action['title'])?></div>
			<div class="descr"><?=cst('GREENBUTTON_CHOICES_'.$action['key'].'_DESCR', $action['descr'])?></div>
		</li>
		<? endforeach ?>
	</ul>
</section>