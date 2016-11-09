<div class="block-iframe">
<?php
$block = $_PARAM['block']['data'];
// class = domain
$domain = explode('.',parse_url($block['src'], PHP_URL_HOST));
end($domain);
$class = prev($domain); // on prend le penultième élément. Ne marche pas sur les domain du type xxxxx.xx.xx
?>
	<iframe class="<?= $class ?>" src="<?php echo $block['src']; ?>" frameborder="0" width="<?php echo $block['width']; ?>" height="<?php echo $block['height']; ?>" allowfullscreen></iframe>
</div>
