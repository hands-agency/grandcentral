<?php
$text = Michelf\Markdown::defaultTransform($_PARAM['block']['data']['text']);
$a = new attrSirtrevor();
$text = $a->convert_links($text);
?>

<?= $text ?>