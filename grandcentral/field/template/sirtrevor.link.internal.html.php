<?php foreach ($items as $item): ?>
	<li data-item="<?=$item->get_abbr()?>"><button>⇠ <?=$item['title']->cut(50)?></button></li>
<?php endforeach ?>