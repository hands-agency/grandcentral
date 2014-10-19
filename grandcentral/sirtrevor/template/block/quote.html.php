<blockquote>
	<p><?= Michelf\Markdown::defaultTransform($_PARAM['block']['data']['text']);?></p>
	<?php if (!empty($_PARAM['block']['data']['cite'])): ?>
	<cite><?= Michelf\Markdown::defaultTransform($_PARAM['block']['data']['cite']);?></cite>	
	<?php endif ?>
</blockquote>