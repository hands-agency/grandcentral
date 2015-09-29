<?php 	
	$items = i($_PARAM['item'],array(
		'order()' => 'created desc'
	));

	$object = i('item',$_PARAM['item']);

	$attributes = array();
	if(isset($object['title']))
		$attributes[] = 'title';
	if(isset($object['descr']))
		$attributes[] = 'descr';
	if(isset($object['description']))
		$attributes[] = 'description';
	if(isset($object['url']))
		$attributes[] = 'url';
	if(isset($object['created']))
		$attributes[] = 'created';
	if(isset($object['updated']))
		$attributes[] = 'updated';

	$page = i('page',current)['url'];
?>

<rss version="2.0">
    <channel>
    	<title> <?= $_PARAM['title'] ?> </title>
    	<description> <?= $_PARAM['descr'] ?> </description>
    	<link> <?= $page ?> </link>
    	<?php foreach($items as $item) : ?>
    	<item>
    		<?php foreach($attributes as $attribute) : ?>
    			<<?= $attribute ?>> <?= $item[$attribute] ?> </<?= $attribute ?>>
	    	<?php endforeach; ?>
    	</item>
	    <?php endforeach ?>
    </channel>
</rss>