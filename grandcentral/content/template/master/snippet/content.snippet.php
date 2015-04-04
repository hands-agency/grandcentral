<?php if (isset($sections)) : foreach($sections as $section) : ?>
	<section id="<?=$section['key']?>" data-displayed="<?=$section['param']['display']?>"></section>
<?php endforeach;endif; ?>