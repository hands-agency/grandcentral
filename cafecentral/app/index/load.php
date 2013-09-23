<?php
	echo '<h1 style="display: block; text-align: center;margin-top: 120px;">Index</h1>';
	$constants = get_defined_constants(true);
	print '<pre>Constantes disponibles : ';print_r($constants['user']);print'</pre>';
	exit;
?>